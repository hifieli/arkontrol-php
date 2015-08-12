<?php

/**
Compile Date: 07/07/15
source: http://ark.gamepedia.com/Server_Configuration

**/

$gameuserini = array(

	'GameUserSettings.ini'	=> array(
	
	
	
		'/script/engine.gamesession'	=> array(
		
			'MaxPlayers'	=> array(
				'name'	=> 'MaxPlayers',
				'type'	=> 'integer',
				'vald'	=> '70',
				'valc'	=> '70',
				'group'	=> 'general',
				'desc'	=> 'Specifies the maximum number of players that can play on the server simultaneously.',
			),
		),
		
		'SessionSettings'	=> array(
		
			'SessionName'	=> array(
				'name'	=> 'SessionName',
				'type'	=> 'string',
				'vald'	=> '',
				'valc'	=> 'ARK dedicated server powered by ARKontrol - arkontrol.com',
				'group'	=> 'general',
				'desc'	=> 'The name of the server as it appears in the server list.',
			),
		),
		
		'ServerSettings'	=> array(
		
			'alwaysNotifyPlayerJoined'	=> array(
				'name'	=> 'alwaysNotifyPlayerJoined',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'player',
				'desc'	=> 'Players will always get notified if someone joins the server',
			),
			'alwaysNotifyPlayerLeft'	=> array(
				'name'	=> 'alwaysNotifyPlayerLeft',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'player',
				'desc'	=> 'Players will always get notified if someone leaves the server',
			),
			'allowThirdPersonPlayer'	=> array(
				'name'	=> 'allowThirdPersonPlayer',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'player',
				'desc'	=> 'Enables 3rd Person view',
			),
			'globalVoiceChat'	=> array(
				'name'	=> 'globalVoiceChat',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Voice chat turns global',
			),
			'ShowMapPlayerLocation'	=> array(
				'name'	=> 'ShowMapPlayerLocation',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Show each player their own precise position when they view their map',
			),
			'noTributeDownloads'	=> array(
				'name'	=> 'noTributeDownloads',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Disables downloading characters from other servers',
			),
			'PreventDownloadSurvivors'	=> array(
				'name'	=> 'PreventDownloadSurvivors',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Disables downloading characters (only) from other servers',
			),
			'PreventDownloadItems'	=> array(
				'name'	=> 'PreventDownloadItems',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Disables downloading items (only) from other servers',
			),
			'PreventDownloadDinos'	=> array(
				'name'	=> 'PreventDownloadDinos',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Disables downloading dinos (only) from other servers',
			),
			'proximityChat'	=> array(
				'name'	=> 'proximityChat',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'player',
				'desc'	=> 'Only players near each other can see their chat messages',
			),
			'serverPVE'	=> array(
				'name'	=> 'serverPVE',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Disables PvP, enables PvE',
			),
			'serverHardcore'	=> array(
				'name'	=> 'serverHardcore',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Enables hardcore mode (player characters revert to level 1 upon death)',
			),
			'serverForceNoHud'	=> array(
				'name'	=> 'serverForceNoHud',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'HUD always disabled',
			),
			
			'AllowCaveBuildingPvE'	=> array(
				'name'	=> 'AllowCaveBuildingPvE',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'environment',
				'desc'	=> 'Allows building structures within caves',
			),
			'bDisableStructureDecayPvE'	=> array(
				'name'	=> 'bDisableStructureDecayPvE',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'environment',
				'desc'	=> 'Disable the gradual (7 days) decay of player structures',
			),
			'bAllowFlyerCarryPvE'	=> array(
				'name'	=> 'bAllowFlyerCarryPvE',
				'type'	=> 'boolean',
				'vald'	=> 'false',
				'valc'	=> 'false',
				'group'	=> 'general',
				'desc'	=> 'Permit flying dinosaurs to pick up other dinosaurs and players when mounted by a player in PvE',
			),
			'MaxStructuresInRange'	=> array(
				'name'	=> 'MaxStructuresInRange',
				'type'	=> 'integer',
				'vald'	=> '1300',
				'valc'	=> '1300',
				'group'	=> 'general',
				'desc'	=> 'Specifies the maximum number of structures that can be constructed within a certain (currently hard-coded) range.',
			),
			'NewMaxStructuresInRange'	=> array(
				'name'	=> 'NewMaxStructuresInRange',
				'type'	=> 'integer',
				'vald'	=> '6000',
				'valc'	=> '6000',
				'group'	=> 'general',
				'desc'	=> 'Specifies the maximum number of structures that can be constructed within a certain range.',
			),			
			'DifficultyOffset'	=> array(
				'name'	=> 'DifficultyOffset',
				'type'	=> 'float',
				'vald'	=> '0',
				'valc'	=> '0',
				'group'	=> 'general',
				'desc'	=> 'Specifies the difficulty level of the creatures and the quality (and frequency) of loot spawned by the server. At 0.0, creatures and loot scale down by approximately 50%. At 1.0, they scale up by approximately 300%.',
			),
			'ServerPassword'	=> array(
				'name'	=> 'ServerPassword',
				'type'	=> 'string',
				'vald'	=> '',
				'valc'	=> '',
				'group'	=> 'authentication',
				'desc'	=> 'If specified, players must provide this password to join the server.',
			),
			'ServerAdminPassword'	=> array(
				'name'	=> 'ServerAdminPassword',
				'type'	=> 'string',
				'vald'	=> '',
				'valc'	=> '',
				'group'	=> 'authentication',
				'desc'	=> 'If specified, players must provide this password (via the in-game console) to gain access to administrator commands on the server.',
			),
			
			'SpectatorPassword'	=> array(
				'name'	=> 'SpectatorPassword',
				'type'	=> 'string',
				'vald'	=> '',
				'valc'	=> '',
				'group'	=> 'authentication',
				'desc'	=> 'If specified, players must provide this password to spectate the server.',
			),
			'DayCycleSpeedScale'	=> array(
				'name'	=> 'DayCycleSpeedScale',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for the passage of time in the ARK, controlling how often day changes to night and night changes to day. The default value 1 provides the same cycle speed as the singleplayer experience (and the official public servers). Values lower than 1 slow down the cycle; higher values accelerate it.  Base time when value is 1 appears to be 1 minute real time equals approx. 28 minutes game time.  Thus, for an approximate 24 hour day/night cycle in game, use .035 for the value.',
			),
			'NightTimeSpeedScale'	=> array(
				'name'	=> 'NightTimeSpeedScale',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for the passage of time in the ARK during night time. This value determines the length of each night, relative to the length of each day (as specified by DayTimeSpeedScale. Lowering this value increases the length of each night.',
			),
			'DayTimeSpeedScale'	=> array(
				'name'	=> 'DayTimeSpeedScale',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for the passage of time in the ARK during the day. This value determines the length of each day, relative to the length of each night (as specified by NightTimeSpeedScale. Lowering this value increases the length of each day.',
			),
			'DinoDamageMultiplier'	=> array(
				'name'	=> 'DinoDamageMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'dino',
				'desc'	=> 'Specifies the scaling factor for the damage dinosaurs deal with their attacks. The default value 1 provides normal damage. Higher values increase damage. Lower values decrease it.',
			),
			'PlayerDamageMultiplier'	=> array(
				'name'	=> 'PlayerDamageMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for the damage players deal with their attacks. The default value 1 provides normal damage. Higher values increase damage. Lower values decrease it.',
			),
			'StructureDamageMultiplier'	=> array(
				'name'	=> 'StructureDamageMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'environment',
				'desc'	=> 'Specifies the scaling factor for the damage structures deal with their attacks (i.e. spiked walls). The default value 1 provides normal damage. Higher values increase damage. Lower values decrease it.',
			),
			'PlayerResistanceMultiplier'	=> array(
				'name'	=> 'PlayerResistanceMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for the resistance to damage players receive when attacked. The default value 1 provides normal damage. Higher values decrease resistance, increasing damage per attack. Lower values increase it, reducing damage per attack. A value of 0.5 results in a player taking half damage while a value of 2.0 would result in taking double normal damage.',
			),
			'DinoResistanceMultiplier'	=> array(
				'name'	=> 'DinoResistanceMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'dino',
				'desc'	=> 'Specifies the scaling factor for the resistance to damage dinosaurs receive when attacked. The default value 1 provides normal damage. Higher values decrease resistance, increasing damage per attack. Lower values increase it, reducing damage per attack. A value of 0.5 results in a dino taking half damage while a value of 2.0 would result in a dino taking double normal damage.',
			),
			'StructureResistanceMultiplier'	=> array(
				'name'	=> 'StructureResistanceMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'environment',
				'desc'	=> 'Specifies the scaling factor for the resistance to damage structures receive when attacked. The default value 1 provides normal damage. Higher values decrease resistance, increasing damage per attack. Lower values increase it, reducing damage per attack. A value of 0.5 results in a structure taking half damage while a value of 2.0 would result in a structure taking double normal damage.',
			),
			'XPMultiplier'	=> array(
				'name'	=> 'XPMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for the experience received by players, tribes and dinosaurs for various actions. The default value 1 provides the same amounts of experience as in the singleplayer experience (and official public servers). Higher values increase XP amounts awarded for various actions; lower values decrease it.',
			),
			'PvEStructureDecayPeriodMultiplier'	=> array(
				'name'	=> 'PvEStructureDecayPeriodMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'environment',
				'desc'	=> 'Specifies the scaling factor for the decay rate of player structures in PvE mode. The specific effect(s) of this option and its range of valid values are unknown as of this writing.',
			),
			'PvEStructureDecayDestructionPeriod'	=> array(
				'name'	=> 'PvEStructureDecayDestructionPeriod',
				'type'	=> 'Unknown',
				'vald'	=> '0',
				'valc'	=> '0',
				'group'	=> 'environment',
				'desc'	=> 'Specifies the time required for player structures to decay in PvE mode. The specific effect(s) of this option and its range of valid values are unknown as of this writing.',
			),
			'TamingSpeedMultiplier'	=> array(
				'name'	=> 'TamingSpeedMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for dinosaur taming speed. Higher values make taming faster.',
			),
			'HarvestAmountMultiplier'	=> array(
				'name'	=> 'HarvestAmountMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for yields from all harvesting activities (chopping down trees, picking berries, carving carcasses, mining rocks, etc.). Higher values increase the amount of materials harvested with each strike.',
			),
			'HarvestHealthMultiplier'	=> array(
				'name'	=> 'HarvestHealthMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for the "health" of items that can be harvested (trees, rocks, carcasses, etc.). Higher values increase the amount of damage (i.e. "number of strikes") such objects can withstand before being destroyed, which results in higher overall harvest yields.',
			),
			'ResourcesRespawnPeriodMultiplier'	=> array(
				'name'	=> 'ResourcesRespawnPeriodMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'scale',
				'desc'	=> 'Specifies the scaling factor for the respawn rate for resource nodes (trees, rocks, bushes, etc.). Higher values cause nodes to respawn more frequently.',
			),
			'PlayerCharacterWaterDrainMultiplier'	=> array(
				'name'	=> 'PlayerCharacterWaterDrainMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for player characters\' water consumption. Higher values increase water consumption (player characters get thirsty faster).',
			),
			'PlayerCharacterFoodDrainMultiplier'	=> array(
				'name'	=> 'PlayerCharacterFoodDrainMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for player characters\' food consumption. Higher values increase food consumption (player characters get hungry faster).',
			),
			'PlayerCharacterStaminaDrainMultiplier'	=> array(
				'name'	=> 'PlayerCharacterStaminaDrainMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for player characters\' stamina consumption. Higher values increase stamina consumption (player characters get tired faster).',
			),
			'PlayerCharacterHealthRecoveryMultiplier'	=> array(
				'name'	=> 'PlayerCharacterHealthRecoveryMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'player',
				'desc'	=> 'Specifies the scaling factor for player characters\' health recovery. Higher values increase the recovery rate (player characters heal faster).',
			),
			'DinoCharacterFoodDrainMultiplier'	=> array(
				'name'	=> 'DinoCharacterFoodDrainMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'dino',
				'desc'	=> 'Specifies the scaling factor for dinosaurs\' food consumption. Higher values increase food consumption (dinosaurs get hungry faster).',
			),
			'DinoCharacterStaminaDrainMultiplier'	=> array(
				'name'	=> 'DinoCharacterStaminaDrainMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'dino',
				'desc'	=> 'Specifies the scaling factor for dinosaurs\' stamina consumption. Higher values increase stamina consumption (dinosaurs get tired faster).',
			),
			'DinoCharacterHealthRecoveryMultiplier'	=> array(
				'name'	=> 'DinoCharacterHealthRecoveryMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'dino',
				'desc'	=> 'Specifies the scaling factor for dinosaurs\' health recovery. Higher values increase the recovery rate (dinosaurs heal faster).',
			),
			'DinoCountMultiplier'	=> array(
				'name'	=> 'DinoCountMultiplier',
				'type'	=> 'float',
				'vald'	=> 1.0,
				'valc'	=> 1.0,
				'group'	=> 'dino',
				'desc'	=> 'Specifies the scaling factor for dinosaur spawns. Higher values increase the number of dinosaurs spawned throughout the ARK.',
			),
		),
	),

	'Game.ini'				=> array(
		'/script/shootergame.shootergamemode'	=> array(
			'PvPZoneStructureDamageMultiplier'	=> array(
				'name'	=> 'PvPZoneStructureDamageMultiplier',
				'type'	=> 'float',
				'vald'	=> 6.0,
				'valc'	=> 6.0,
				'group'	=> 'environment',
				'desc'	=> 'In PvP, structures within caves/cave-entrances now take 6x damage',
			),		
			'OverrideMaxExperiencePointsPlayer'	=> array(
				'name'	=> 'OverrideMaxExperiencePointsPlayer',
				'type'	=> 'integer',
				'vald'	=> 0,
				'valc'	=> 0,
				'group'	=> 'player',
				'desc'	=> 'Set to larger than 0 to override the Max XP cap of players characters',
			),	
			'OverrideMaxExperiencePointsDino'	=> array(
				'name'	=> 'OverrideMaxExperiencePointsDino',
				'type'	=> 'float',
				'vald'	=> 0,
				'valc'	=> 0,
				'group'	=> 'player',
				'desc'	=> 'Set to larger than 0 to override the Max XP cap of dino characters',
			),
			'GlobalSpoilingTimeMultiplier'	=> array(
				'name'	=> 'GlobalSpoilingTimeMultiplier',
				'type'	=> 'float',
				'vald'	=> 0,
				'valc'	=> 0,
				'group'	=> 'environment',
				'desc'	=> 'Set to larger than 0 to override the spoiling time of perishables',
			),
			'GlobalItemDecompositionTimeMultiplier'	=> array(
				'name'	=> 'GlobalItemDecompositionTimeMultiplier',
				'type'	=> 'float',
				'vald'	=> 0,
				'valc'	=> 0,
				'group'	=> 'environment',
				'desc'	=> 'Set to larger than 0 to override the decomposition time for items on the ground',
			),	
			'GlobalCorpseDecompositionTimeMultiplier'	=> array(
				'name'	=> 'GlobalCorpseDecompositionTimeMultiplier',
				'type'	=> 'float',
				'vald'	=> 0,
				'valc'	=> 0,
				'group'	=> 'environment',
				'desc'	=> 'Set to larger than 0 to override the decomposition time for corpses on the ground',
			),	
		),
/*

to prevent Taming of specific Dino's:
[/script/shootergame.shootergamemode]
PreventDinoTameClassNames="Argent_Character_BP_C"
PreventDinoTameClassNames="Ptero_Character_BP_C"
//etc etc -- all dino classnames are in the ARK Dev Kit
D:\SteamLibrary\steamapps\common\ARKDevKit\Projects\ShooterGame\Content\PrimalEarth\Dinos
Ankylo_Character_BP.uasset
Ant_Character_BP.uasset
Argent_Character_BP.uasset
Bat_Character_BP.uasset
BoaFrill_Character_BP.uasset
Carno_Character_BP.uasset
Coel_Character_BP.uasset
Dilo_Character_BP.uasset
Dimorph_Character_BP.uasset
Dodo_Character_BP.uasset
Dolphin_Character_BP.uasset
Dragonfly_Character_BP.uasset
FlyingAnt_Character_BP.uasset
Mammoth_Character_BP.uasset
Megalodon_Character_BP.uasset
MegaRex_Character_BP.uasset
Para_Character_BP.uasset
Phiomia_Character_BP.uasset
Piranha_Character_BP.uasset
Plesiosaur_Character_BP.uasset
Ptero_Character_BP.uasset
Raptor_Character_BP.uasset
Rex_Character_BP.uasset
Saber_Character_BP.uasset
Sarco_Character_BP.uasset
Sauropod_Character_BP.uasset
Scorpion_Character_BP.uasset
SpiderL_Character_BP.uasset
SpiderS_Character_BP.uasset
Spino_Character_BP.uasset
Stego_Character_BP.uasset
Trike_Character_BP.uasset
Turtle_Character_BP.uasset


* Custom servers INI can now scale on a per-resource type basis the amount of resources harvested. In your server's Game.ini, for example:
[/script/shootergame.shootergamemode]
HarvestResourceItemAmountClassMultipliers=(ClassName="PrimalItemResource_Thatch_C",Multiplier=2.0)
HarvestResourceItemAmountClassMultipliers=(ClassName="PrimalItemResource_Stone_C",Multiplier=4.0)
D:\SteamLibrary\steamapps\common\ARKDevKit\Projects\ShooterGame\Content\PrimalEarth\CoreBlueprints\Resources

PrimalItemResource_Charcoal
PrimalItemResource_Chitin
PrimalItemResource_ChitinPaste
PrimalItemResource_Craftable
PrimalItemResource_Crystal
PrimalItemResource_Electronics
PrimalItemResource_Fibers
PrimalItemResource_Flint
PrimalItemResource_Gasoline
PrimalItemResource_Gunpowder
PrimalItemResource_Hide
PrimalItemResource_Keratin
PrimalItemResource_Metal
PrimalItemResource_MetalIngot
PrimalItemResource_Obsidian
PrimalItemResource_Oil
PrimalItemResource_Polymer
PrimalItemResource_RareFlower
PrimalItemResource_RareMushroom
PrimalItemResource_Silicon
PrimalItemResource_Sparkpowder
PrimalItemResource_Stone
PrimalItemResource_Temp
PrimalItemResource_Thatch
PrimalItemResource_Wood

//I don't think these make sense in the 'harvest' context, but we shall see.
PrimalItemResource_ApexDrop_Argentavis
PrimalItemResource_ApexDrop_Megalodon
PrimalItemResource_ApexDrop_Rex
PrimalItemResource_ApexDrop_Sauro
PrimalItemResource_ChitinOrKeratin



[/script/shootergame.shootergamemode]
bOnlyAllowSpecifiedEngrams=true/false
Defaults false. If true, any Engram not explicitly specified in the EngramsOverride list will be Hidden. Useful for maintaining primitive servers even as we add new Engrams in Updates.

*/

	),

	
);

?>