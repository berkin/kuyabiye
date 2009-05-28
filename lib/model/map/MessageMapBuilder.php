<?php



class MessageMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MessageMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('messages');
		$tMap->setPhpName('Message');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CONVERSATION_ID', 'ConversationId', 'int', CreoleTypes::INTEGER, 'conversations', 'ID', false, null);

		$tMap->addForeignKey('WRITER', 'Writer', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('READ', 'Read', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 