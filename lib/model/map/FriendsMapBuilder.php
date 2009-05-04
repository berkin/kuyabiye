<?php



class FriendsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FriendsMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('friends');
		$tMap->setPhpName('Friends');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USER_FROM', 'UserFrom', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USER_TO', 'UserTo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, true, null);

	} 
} 