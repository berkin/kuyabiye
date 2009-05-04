<?php



class TagsCommentsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagsCommentsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tags_comments');
		$tMap->setPhpName('TagsComments');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TAGS_ID', 'TagsId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USERS_ID', 'UsersId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TREE_LEFT', 'TreeLeft', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TREE_RIGHT', 'TreeRight', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 