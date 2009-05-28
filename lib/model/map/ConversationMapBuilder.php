<?php



class ConversationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConversationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('conversations');
		$tMap->setPhpName('Conversation');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('SENDER', 'Sender', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('RECIPENT', 'Recipent', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('IS_REPLIED', 'IsReplied', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('SENDER_IS_REPLIED', 'SenderIsReplied', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('RECIPENT_IS_REPLIED', 'RecipentIsReplied', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('SENDER_IS_DELETED', 'SenderIsDeleted', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('RECIPENT_IS_DELETED', 'RecipentIsDeleted', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('SENDER_IS_READ', 'SenderIsRead', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('RECIPENT_IS_READ', 'RecipentIsRead', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 