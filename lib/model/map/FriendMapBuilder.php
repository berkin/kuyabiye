<?php



class FriendMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FriendMapBuilder';

	
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
		$tMap->setPhpName('Friend');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_FROM', 'UserFrom', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('USER_TO', 'UserTo', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::TINYINT, true, null);

	} 
} 