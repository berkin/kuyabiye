<?php


abstract class BaseTagPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tags';

	
	const CLASS_DEFAULT = 'lib.model.Tag';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'tags.ID';

	
	const TAG = 'tags.TAG';

	
	const STRIPPED_TAG = 'tags.STRIPPED_TAG';

	
	const CREATED_BY = 'tags.CREATED_BY';

	
	const LOVERS = 'tags.LOVERS';

	
	const HATERS = 'tags.HATERS';

	
	const LOVER_GIRLS = 'tags.LOVER_GIRLS';

	
	const HATER_GIRLS = 'tags.HATER_GIRLS';

	
	const NB_COMMENTS = 'tags.NB_COMMENTS';

	
	const LOVE = 'tags.LOVE';

	
	const STICKY = 'tags.STICKY';

	
	const IS_ON_HOMEPAGE = 'tags.IS_ON_HOMEPAGE';

	
	const CREATED_AT = 'tags.CREATED_AT';

	
	const UPDATED_AT = 'tags.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Tag', 'StrippedTag', 'CreatedBy', 'Lovers', 'Haters', 'LoverGirls', 'HaterGirls', 'NbComments', 'Love', 'Sticky', 'IsOnHomepage', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (TagPeer::ID, TagPeer::TAG, TagPeer::STRIPPED_TAG, TagPeer::CREATED_BY, TagPeer::LOVERS, TagPeer::HATERS, TagPeer::LOVER_GIRLS, TagPeer::HATER_GIRLS, TagPeer::NB_COMMENTS, TagPeer::LOVE, TagPeer::STICKY, TagPeer::IS_ON_HOMEPAGE, TagPeer::CREATED_AT, TagPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'tag', 'stripped_tag', 'created_by', 'lovers', 'haters', 'lover_girls', 'hater_girls', 'nb_comments', 'love', 'sticky', 'is_on_homepage', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Tag' => 1, 'StrippedTag' => 2, 'CreatedBy' => 3, 'Lovers' => 4, 'Haters' => 5, 'LoverGirls' => 6, 'HaterGirls' => 7, 'NbComments' => 8, 'Love' => 9, 'Sticky' => 10, 'IsOnHomepage' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ),
		BasePeer::TYPE_COLNAME => array (TagPeer::ID => 0, TagPeer::TAG => 1, TagPeer::STRIPPED_TAG => 2, TagPeer::CREATED_BY => 3, TagPeer::LOVERS => 4, TagPeer::HATERS => 5, TagPeer::LOVER_GIRLS => 6, TagPeer::HATER_GIRLS => 7, TagPeer::NB_COMMENTS => 8, TagPeer::LOVE => 9, TagPeer::STICKY => 10, TagPeer::IS_ON_HOMEPAGE => 11, TagPeer::CREATED_AT => 12, TagPeer::UPDATED_AT => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'tag' => 1, 'stripped_tag' => 2, 'created_by' => 3, 'lovers' => 4, 'haters' => 5, 'lover_girls' => 6, 'hater_girls' => 7, 'nb_comments' => 8, 'love' => 9, 'sticky' => 10, 'is_on_homepage' => 11, 'created_at' => 12, 'updated_at' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/TagMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.TagMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TagPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(TagPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TagPeer::ID);

		$criteria->addSelectColumn(TagPeer::TAG);

		$criteria->addSelectColumn(TagPeer::STRIPPED_TAG);

		$criteria->addSelectColumn(TagPeer::CREATED_BY);

		$criteria->addSelectColumn(TagPeer::LOVERS);

		$criteria->addSelectColumn(TagPeer::HATERS);

		$criteria->addSelectColumn(TagPeer::LOVER_GIRLS);

		$criteria->addSelectColumn(TagPeer::HATER_GIRLS);

		$criteria->addSelectColumn(TagPeer::NB_COMMENTS);

		$criteria->addSelectColumn(TagPeer::LOVE);

		$criteria->addSelectColumn(TagPeer::STICKY);

		$criteria->addSelectColumn(TagPeer::IS_ON_HOMEPAGE);

		$criteria->addSelectColumn(TagPeer::CREATED_AT);

		$criteria->addSelectColumn(TagPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(tags.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tags.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = TagPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TagPeer::populateObjects(TagPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTagPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseTagPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TagPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TagPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagPeer::CREATED_BY, UserPeer::ID);

		$rs = TagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TagPeer::addSelectColumns($c);
		$startcol = (TagPeer::NUM_COLUMNS - TagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(TagPeer::CREATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addTag($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTags();
				$obj2->addTag($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagPeer::CREATED_BY, UserPeer::ID);

		$rs = TagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TagPeer::addSelectColumns($c);
		$startcol2 = (TagPeer::NUM_COLUMNS - TagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(TagPeer::CREATED_BY, UserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTag($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initTags();
				$obj2->addTag($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return TagPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTagPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTagPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(TagPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseTagPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTagPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTagPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTagPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TagPeer::ID);
			$selectCriteria->add(TagPeer::ID, $criteria->remove(TagPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTagPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTagPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(TagPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(TagPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Tag) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TagPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Tag $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TagPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TagPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(TagPeer::DATABASE_NAME, TagPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TagPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(TagPeer::DATABASE_NAME);

		$criteria->add(TagPeer::ID, $pk);


		$v = TagPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(TagPeer::ID, $pks, Criteria::IN);
			$objs = TagPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTagPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/TagMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.TagMapBuilder');
}
