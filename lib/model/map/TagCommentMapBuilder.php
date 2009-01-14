<?php



class TagCommentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagCommentMapBuilder';

	
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
		$tMap->setPhpName('TagComment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TAGS_ID', 'TagsId', 'int', CreoleTypes::INTEGER, 'tags', 'ID', false, null);

		$tMap->addForeignKey('USERS_ID', 'UsersId', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TREE_LEFT', 'TreeLeft', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TREE_RIGHT', 'TreeRight', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TREE_PARENT', 'TreeParent', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SCOPE', 'Scope', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 