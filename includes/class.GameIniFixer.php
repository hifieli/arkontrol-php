<?php

/**
	Quick and dirty object to handle the ini files with  syntax.
	
	This class does what parse_ini_file() does, but handles the incorrect
	syntax (missing brackets) as well as conveniently breaking their
	parenthetical notation down into an array.

	proper ini syntax would have been to representing multiple entries of the 
	same key with array brackets [].

	Proper array notation in an INI file.
		[/script/shootergame.shootergamemode]
		OverrideEngramEntries[]=(EngramIndex=105,EngramHidden=true)
		OverrideEngramEntries[]=(EngramIndex=106,EngramHidden=true)
		OverrideEngramEntries[]=(EngramIndex=107,EngramHidden=true)

	Actual way ARK's Game.ini works
		[/script/shootergame.shootergamemode]
		OverrideEngramEntries=(EngramIndex=105,EngramHidden=true)
		OverrideEngramEntries=(EngramIndex=106,EngramHidden=true)
		OverrideEngramEntries=(EngramIndex=107,EngramHidden=true)

		
	FWIW, it is probably that way because that is the way the unreal
	engine requires it, I don't have enough data to make any conclusions.
	This issue may not be endimic to ARK.
*/


/*

	Sample usage.

	$iniGame	= new GameIniFixer($_INICONF);
	
	$Engrams	= $iniGame->gameini['/script/shootergame.shootergamemode']['OverrideEngramEntries'];
	
	$Engrams[6]['EngramPointsCost'] = 1;
	
	$iniGame->gameini['/script/shootergame.shootergamemode']['OverrideEngramEntries'] = $Engrams;
	
	$iniGame->write();

*/

class GameIniFixer {
	
	//these are the keys that need brackets
	public $inikeys	= array(
		'OverrideEngramEntries',
		'OverrideNamedEngramEntries',
		'DinoSpawnWeightMultipliers',
		'LevelExperienceRampOverrides',
		'OverridePlayerLevelEngramPoints',
		'HarvestResourceItemAmountClassMultipliers',
		'PreventDinoTameClassNames',
		'NPCReplacements',
	);
	
	//these keys need their values to be quoted like this one: OverrideNamedEngramEntries=(EngramClassName="EngramEntry_AlarmTrap_C",EngramHidden=true,EngramPointsCost=3,EngramLevelRequirement=2,RemoveEngramPreReq=false)
	public $stringkeys	= array(
		'EngramClassName',
		'ClassName',
		'DinoNameTag',
		'FromClassName',
		'ToClassName',
	);
	
	//This is the file with the incorrect ini syntax *shakes fist*
	public $inifile 		= 'Game.ini';
	
	public $inipath;	//full path to ini file
	public $_INICONF;	//$_INICONF
	
	public $gameini;	//Game.ini as array of arrays
	public $gameinistr;	//Game.ini as array of strings
	
	
	
	function __construct($_INICONF, $inifile = 'Game.ini') {
		
		$this->_INICONF	= $_INICONF;
		
		if (!empty($inifile)) {
			$this->inifile = $inifile;
		}
		
		$this->inipath	= $this->_INICONF['settingspath'] . "/{$this->inifile}";
		
		$this->get();
	}
	
	public function get() {
		
		$this->_getfileasarray();
		
		foreach ($this->gameinistr as $ini_sect => $kvp_array) {
			
			foreach ($kvp_array as $key => $val) {
				
				if (is_array($val)) {
					
					foreach ($val as $param => $info) {
						$this->gameini[ $ini_sect ][ $key ][] = $this->_decodeData($info);
					}
					
				} else {
					
					$this->gameini[ $ini_sect ][ $key ] = $val;
					
				}
			}
		}
		
		return $this->gameini;
	}
	
	public function write() {
		
		$this->gameinistr = array();
		
		foreach ($this->gameini as $ini_sect => $kvp_array) {
			
			foreach ($kvp_array as $key => $val) {
				
				if (is_array($val)) {
					
					foreach ($val as $param => $info) {
						$this->gameinistr[ $ini_sect ][ $key ][ $param ]  = $this->_encodeData($info);
					}
					
				} else {
					
					$this->gameinistr[ $ini_sect ][ $key ] = $val;
				}
				
			}
		}
		
		$this->_writearraytofile();
		
		return true;
	}
	
	private function _decodeData($fromini = null) {
		
		$final = array();
		
		if (!empty($fromini)) {
			
				
			if (strstr($fromini,'(') !== false) {
				//"(EngramIndex=1,EngramHidden=false)"
				
				//remove parens
				$fromini = str_replace('(', '', $fromini);
				$fromini = str_replace(')', '', $fromini);
				
				//"EngramIndex=1,EngramHidden=false"
				
				//split kvp's on the comma
				$KVp	= explode(',', $fromini); 
				//array('EngramIndex=1','EngramHidden=false')
				
				//split each key/value pair out and put into an array
				foreach ($KVp as $pair) {
					
					$parts					= explode('=', $pair);
					$final [ $parts[0] ]	= $parts[1];
					
				}
				//array('EngramIndex'=>1,'EngramHidden'=>false)
				
			} else {
				
				$final = $fromini;
				
			}
		}
		return $final;
	}
	
	private function _encodeData($asarray = null) {
		
		$final	= '';
		
		if (!empty($asarray)) {
			
			if (is_array($asarray)) {
				
				foreach ($asarray as $key => $val) {
					
					if ($val === false) {
						$final	.= "{$key}=false,";
					} elseif ($val === true) {
						$final	.= "{$key}=true,";
					} else {
						
						if (is_string($key) && in_array($key, $this->stringkeys)) {	//quote the value if it needs to be quoted. See $this->stringkeys up above.
							$val = '"' . $val . '"';
						}
						
						$final	.= "{$key}={$val},";
					}
					
				}
				$final	= rtrim($final, ',');
				
				$final	= '(' . $final . ')';
				
				//(EngramIndex=1,EngramHidden=false,EngramPointsCost=3,EngramLevelRequirement=3,RemoveEngramPreReq=true)
			} else {
				
				$final	= $asarray; //not an array, just pass the value back
				
			}
		}

		return $final;
	}		
	
	public function _getfileasarray() {
		
		if (empty($this->gameinistr)) {
			$this->_fix();
			$this->gameinistr	= parse_ini_file($this->inipath, true, INI_SCANNER_RAW);
			$this->_unfix();
		}
		
		return $this->gameinistr;
	}
	
	public function _writearraytofile() {
		
		if (!empty($this->gameinistr)) {
			
			//just go ahead and write it out in the incorrect syntax
			$newlines		= array();
			
			foreach ($this->gameinistr as $ini_sect => $sect_arr) {
				
				$newlines[]	= "[{$ini_sect}]";
				
				foreach ($sect_arr as $key => $info) { //brackets missing intentionally. that's the reason we have to do all of this.
				
					if (is_array($info)) {
						
						foreach ($info as $idx => $val) {
							if ($val === false) {
								$newlines[] = "{$key}=false";
							} elseif ($val === true) {
								$newlines[] = "{$key}=true";
							} else {
								$newlines[] = "{$key}={$val}";
							}
						}
						
					} else {
						
						if ($info === false) {
							$newlines[] = "{$key}=false";
						} elseif ($info === true) {
							$newlines[] = "{$key}=true";
						} else {
							$newlines[] = "{$key}={$info}";
						}
					}
				}
				
				$newlines[]	= "";
				
			}
			
			if (!empty($newlines)) {
				file_put_contents($this->inipath, implode("\r\n", $newlines));
			}
			
		}			
		
		return true;
	}
	
	public function _fix() { //correct the incorrect syntax
	
		$inicontents	= file_get_contents($this->inipath);
		
		//Replace each key with the keyname and a bracket, correcting the syntax
		foreach ($this->inikeys as $inikey) {
			$inicontents	= str_replace($inikey, "{$inikey}[]", $inicontents);
		}
		
		//Put the corrected syntax back into the file.
		file_put_contents($this->inipath, $inicontents);
		
		return true;
	}
	
	public function _unfix() { //break the corrected syntax
		
		$inicontents	= file_get_contents($this->inipath);
		
		//Replace each key with the keyname and a bracket, correcting the syntax
		foreach ($this->inikeys as $inikey) {
			$inicontents	= str_replace("{$inikey}[]", $inikey, $inicontents);
		}
		
		//Put the corrected syntax back into the file.
		file_put_contents($this->inipath, $inicontents);
		
		return true;	
	}	
}