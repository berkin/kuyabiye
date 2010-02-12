<?php



class ActivationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ActivationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('activation_codes');
		$tMap->setPhpName('Activation');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CODE', 'Code', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TOTAL', 'Total', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AVAILABLE', 'Available', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 