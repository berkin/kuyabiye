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

		$tMap->addForeignKey('SENDER', 'Sender', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('RECIPENT', 'Recipent', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('SENDER_FOLDER', 'SenderFolder', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('RECIPENT_FOLDER', 'RecipentFolder', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CONVERSATION', 'Conversation', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('READ', 'Read', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 