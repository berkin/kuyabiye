<?php



class UsersToTagsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UsersToTagsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('users_to_tags');
		$tMap->setPhpName('UsersToTags');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USERS_ID', 'UsersId', 'int' , CreoleTypes::INTEGER, 'users', 'ID', true, null);

		$tMap->addForeignPrimaryKey('TAGS_ID', 'TagsId', 'int' , CreoleTypes::INTEGER, 'tags', 'ID', true, null);

		$tMap->addColumn('LOVE', 'Love', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 