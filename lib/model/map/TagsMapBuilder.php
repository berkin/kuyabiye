<?php



class TagsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagsMapBuilder';

	
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
		$tMap->setPhpName('Tags');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TAG', 'Tag', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('STRIPPED_TAG', 'StrippedTag', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LOVERS', 'Lovers', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HATERS', 'Haters', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 