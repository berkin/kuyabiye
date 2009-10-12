<?php



class TagMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tags');
		$tMap->setPhpName('Tag');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TAG', 'Tag', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('STRIPPED_TAG', 'StrippedTag', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('LOVERS', 'Lovers', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HATERS', 'Haters', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LOVER_GIRLS', 'LoverGirls', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HATER_GIRLS', 'HaterGirls', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NB_COMMENTS', 'NbComments', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LOVE', 'Love', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('STICKY', 'Sticky', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('IS_ON_HOMEPAGE', 'IsOnHomepage', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 