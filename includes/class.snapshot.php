<?php

	class snapshot {
		
		public $_INICONF;
		
		public $profile_basedir;
		
		public $all_ini	= array();
		
		public $valid_types	= array('custom', 'snapshot');
	
	
		function __construct($_INICONF) {
			$this->_INICONF			= $_INICONF;
			
			$this->profile_basedir	= "{$_INICONF['webdocroot']}/profiles"; // . "/custom/{$profile_name}" . "/snapshot/{$profile_name}"
		
		}
		
		public function create($profile_name = null, $type = 'custom') {
			
			$this->list_ini();
			
			$ini_current	= array();
			foreach ($this->all_ini as $this_ini) {
				$ini_string					= file_get_contents($this->_INICONF['settingspath'] . "/{$this_ini}");
				$ini_current[ $this_ini ]	= $ini_string;
			}
			
			$friendlydate	= date("Ymd-His");
			$profile_name	= (!empty($profile_name)) ? $profile_name : "ark-conf-profile-{$friendlydate}";
			$profile_name	= preg_replace("/[^A-Za-z0-9]/", '', $profile_name);
			$profile_name	= preg_replace("/ -/", '_', $profile_name);
			$profile_name	= (!empty($_POST['profile_name'])) ? $_POST['profile_name'] : "ark-conf-profile-{$friendlydate}";
			
			return file_put_contents($this->profile_basedir . "/{$type}/{$profile_name}.json", json_encode($ini_current));
			
		}
		
		public function restore($profile_name, $type = 'custom') {
			
			if (!in_array($type, $this->valid_types)) return false;
			
			$this->list_ini();
			
			$profile_as_string	= (file_exists($this->profile_basedir . "/{$type}/{$profile_name}")) ? file_get_contents($this->profile_basedir . "/{$type}/{$profile_name}") : '[]';
			$profile_as_array	= json_decode($profile_as_string, true);
			
			foreach ($this->all_ini as $this_ini) {
				if (!empty($profile_as_array[ $this_ini ])) {
					file_put_contents($this->_INICONF['settingspath'] . "/{$this_ini}", $profile_as_array[ $this_ini ]);
				}
			}
			
			return true;
		}
		
		public function get($profile_name, $type = 'custom') {
			
			if (!in_array($type, $this->valid_types)) return false;
			
			$all_profs	= $this->list_profiles($type);
			
			if (!in_array($profile_name, $all_profs)) return false;
			
		//	$profile_as_string	= (file_exists($this->profile_basedir . "/{$type}/{$profile_name}")) ? file_get_contents($this->profile_basedir . "/{$type}/{$profile_name}") : '[]';
			$profile_as_string	= file_get_contents($this->profile_basedir . "/{$type}/{$profile_name}");
			$profile_as_array	= @json_decode($profile_as_string, true);
			
			return (empty($profile_as_array)) ? array() : $profile_as_array;
		}
		
		public function list_profiles($type = 'custom') {
			
			$all_prof	= scandir($this->profile_basedir . "/{$type}");
			$real_prof	= array();
			foreach ($all_prof as $this_prof) {
				if (($this_prof != '.')  && ($this_prof != '..')) {
					$real_prof[]	= $this_prof;
				}
			}
			
			return $real_prof;
		}
		
		public function delete($profile_name, $type = 'custom') {
			if (!in_array($type, $this->valid_types)) return false;
			
			$all_profs	= $this->list_profiles($type);
			
			if (!in_array($profile_name, $all_profs)) return false;
			
			if (file_exists($this->profile_basedir . "/{$type}/{$profile_name}")) {
				unlink($this->profile_basedir . "/{$type}/{$profile_name}");
				return true;
			} else {
				return false;
			}
			
			
		}
		
		public function list_ini() {
			
			if (empty($this->all_ini)) {
				
				$all_ini	= scandir($this->_INICONF['settingspath']);
				
				foreach ($all_ini as $this_ini) {
					if (($this_ini != '.')  && ($this_ini != '..')) {
						$this->all_ini[]	= $this_ini;
					}
				}
				
			}
			
			return $this->all_ini;
			
		}
	
	}