<?php



class UserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('users');
		$tMap->setPhpName('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NICKNAME', 'Nickname', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('REMEMBER_KEY', 'RememberKey', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('AVATAR', 'Avatar', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('ACTIVATION_CODE', 'ActivationCode', 'int', CreoleTypes::INTEGER, 'activation_codes', 'ID', false, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('COUNTRY', 'Country', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('GENDER', 'Gender', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('DOB', 'Dob', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('QUOTE', 'Quote', 'string', CreoleTypes::VARCHAR, false, 140);

		$tMap->addColumn('NB_LOVES', 'NbLoves', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NB_HATES', 'NbHates', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FB_IS_ON', 'FbIsOn', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('FB_UUID', 'FbUuid', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('FB_SESSION_KEY', 'FbSessionKey', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('FB_PUBLISH_STATUS', 'FbPublishStatus', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('FB_PUBLISH_LOVE', 'FbPublishLove', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('FB_PUBLISH_COMMENT', 'FbPublishComment', 'int', CreoleTypes::TINYINT, true, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 