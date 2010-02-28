<?php


abstract class BaseUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'users';

	
	const CLASS_DEFAULT = 'lib.model.User';

	
	const NUM_COLUMNS = 24;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'users.ID';

	
	const NICKNAME = 'users.NICKNAME';

	
	const EMAIL = 'users.EMAIL';

	
	const SHA1_PASSWORD = 'users.SHA1_PASSWORD';

	
	const SALT = 'users.SALT';

	
	const REMEMBER_KEY = 'users.REMEMBER_KEY';

	
	const AVATAR = 'users.AVATAR';

	
	const ACTIVATION_CODE = 'users.ACTIVATION_CODE';

	
	const FIRST_NAME = 'users.FIRST_NAME';

	
	const LAST_NAME = 'users.LAST_NAME';

	
	const COUNTRY = 'users.COUNTRY';

	
	const CITY = 'users.CITY';

	
	const GENDER = 'users.GENDER';

	
	const DOB = 'users.DOB';

	
	const QUOTE = 'users.QUOTE';

	
	const NB_LOVES = 'users.NB_LOVES';

	
	const NB_HATES = 'users.NB_HATES';

	
	const FB_IS_ON = 'users.FB_IS_ON';

	
	const FB_UUID = 'users.FB_UUID';

	
	const FB_SESSION_KEY = 'users.FB_SESSION_KEY';

	
	const FB_PUBLISH_STATUS = 'users.FB_PUBLISH_STATUS';

	
	const FB_PUBLISH_LOVE = 'users.FB_PUBLISH_LOVE';

	
	const FB_PUBLISH_COMMENT = 'users.FB_PUBLISH_COMMENT';

	
	const CREATED_AT = 'users.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Nickname', 'Email', 'Sha1Password', 'Salt', 'RememberKey', 'Avatar', 'ActivationCode', 'FirstName', 'LastName', 'Country', 'City', 'Gender', 'Dob', 'Quote', 'NbLoves', 'NbHates', 'FbIsOn', 'FbUuid', 'FbSessionKey', 'FbPublishStatus', 'FbPublishLove', 'FbPublishComment', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (UserPeer::ID, UserPeer::NICKNAME, UserPeer::EMAIL, UserPeer::SHA1_PASSWORD, UserPeer::SALT, UserPeer::REMEMBER_KEY, UserPeer::AVATAR, UserPeer::ACTIVATION_CODE, UserPeer::FIRST_NAME, UserPeer::LAST_NAME, UserPeer::COUNTRY, UserPeer::CITY, UserPeer::GENDER, UserPeer::DOB, UserPeer::QUOTE, UserPeer::NB_LOVES, UserPeer::NB_HATES, UserPeer::FB_IS_ON, UserPeer::FB_UUID, UserPeer::FB_SESSION_KEY, UserPeer::FB_PUBLISH_STATUS, UserPeer::FB_PUBLISH_LOVE, UserPeer::FB_PUBLISH_COMMENT, UserPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'nickname', 'email', 'sha1_password', 'salt', 'remember_key', 'avatar', 'activation_code', 'first_name', 'last_name', 'country', 'city', 'gender', 'dob', 'quote', 'nb_loves', 'nb_hates', 'fb_is_on', 'fb_uuid', 'fb_session_key', 'fb_publish_status', 'fb_publish_love', 'fb_publish_comment', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Nickname' => 1, 'Email' => 2, 'Sha1Password' => 3, 'Salt' => 4, 'RememberKey' => 5, 'Avatar' => 6, 'ActivationCode' => 7, 'FirstName' => 8, 'LastName' => 9, 'Country' => 10, 'City' => 11, 'Gender' => 12, 'Dob' => 13, 'Quote' => 14, 'NbLoves' => 15, 'NbHates' => 16, 'FbIsOn' => 17, 'FbUuid' => 18, 'FbSessionKey' => 19, 'FbPublishStatus' => 20, 'FbPublishLove' => 21, 'FbPublishComment' => 22, 'CreatedAt' => 23, ),
		BasePeer::TYPE_COLNAME => array (UserPeer::ID => 0, UserPeer::NICKNAME => 1, UserPeer::EMAIL => 2, UserPeer::SHA1_PASSWORD => 3, UserPeer::SALT => 4, UserPeer::REMEMBER_KEY => 5, UserPeer::AVATAR => 6, UserPeer::ACTIVATION_CODE => 7, UserPeer::FIRST_NAME => 8, UserPeer::LAST_NAME => 9, UserPeer::COUNTRY => 10, UserPeer::CITY => 11, UserPeer::GENDER => 12, UserPeer::DOB => 13, UserPeer::QUOTE => 14, UserPeer::NB_LOVES => 15, UserPeer::NB_HATES => 16, UserPeer::FB_IS_ON => 17, UserPeer::FB_UUID => 18, UserPeer::FB_SESSION_KEY => 19, UserPeer::FB_PUBLISH_STATUS => 20, UserPeer::FB_PUBLISH_LOVE => 21, UserPeer::FB_PUBLISH_COMMENT => 22, UserPeer::CREATED_AT => 23, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'nickname' => 1, 'email' => 2, 'sha1_password' => 3, 'salt' => 4, 'remember_key' => 5, 'avatar' => 6, 'activation_code' => 7, 'first_name' => 8, 'last_name' => 9, 'country' => 10, 'city' => 11, 'gender' => 12, 'dob' => 13, 'quote' => 14, 'nb_loves' => 15, 'nb_hates' => 16, 'fb_is_on' => 17, 'fb_uuid' => 18, 'fb_session_key' => 19, 'fb_publish_status' => 20, 'fb_publish_love' => 21, 'fb_publish_comment' => 22, 'created_at' => 23, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UserPeer::getTableMap();
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
		return str_replace(UserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserPeer::ID);

		$criteria->addSelectColumn(UserPeer::NICKNAME);

		$criteria->addSelectColumn(UserPeer::EMAIL);

		$criteria->addSelectColumn(UserPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(UserPeer::SALT);

		$criteria->addSelectColumn(UserPeer::REMEMBER_KEY);

		$criteria->addSelectColumn(UserPeer::AVATAR);

		$criteria->addSelectColumn(UserPeer::ACTIVATION_CODE);

		$criteria->addSelectColumn(UserPeer::FIRST_NAME);

		$criteria->addSelectColumn(UserPeer::LAST_NAME);

		$criteria->addSelectColumn(UserPeer::COUNTRY);

		$criteria->addSelectColumn(UserPeer::CITY);

		$criteria->addSelectColumn(UserPeer::GENDER);

		$criteria->addSelectColumn(UserPeer::DOB);

		$criteria->addSelectColumn(UserPeer::QUOTE);

		$criteria->addSelectColumn(UserPeer::NB_LOVES);

		$criteria->addSelectColumn(UserPeer::NB_HATES);

		$criteria->addSelectColumn(UserPeer::FB_IS_ON);

		$criteria->addSelectColumn(UserPeer::FB_UUID);

		$criteria->addSelectColumn(UserPeer::FB_SESSION_KEY);

		$criteria->addSelectColumn(UserPeer::FB_PUBLISH_STATUS);

		$criteria->addSelectColumn(UserPeer::FB_PUBLISH_LOVE);

		$criteria->addSelectColumn(UserPeer::FB_PUBLISH_COMMENT);

		$criteria->addSelectColumn(UserPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(users.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT users.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UserPeer::doSelectRS($criteria, $con);
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
		$objects = UserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UserPeer::populateObjects(UserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUserPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseUserPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UserPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinActivation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserPeer::ACTIVATION_CODE, ActivationPeer::ID);

		$rs = UserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinActivation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserPeer::addSelectColumns($c);
		$startcol = (UserPeer::NUM_COLUMNS - UserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActivationPeer::addSelectColumns($c);

		$c->addJoin(UserPeer::ACTIVATION_CODE, ActivationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActivationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getActivation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUsers();
				$obj2->addUser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserPeer::ACTIVATION_CODE, ActivationPeer::ID);

		$rs = UserPeer::doSelectRS($criteria, $con);
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

		UserPeer::addSelectColumns($c);
		$startcol2 = (UserPeer::NUM_COLUMNS - UserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActivationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActivationPeer::NUM_COLUMNS;

		$c->addJoin(UserPeer::ACTIVATION_CODE, ActivationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ActivationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActivation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUser($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUsers();
				$obj2->addUser($obj1);
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
		return UserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUserPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUserPeer', $values, $con);
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

		$criteria->remove(UserPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseUserPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseUserPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUserPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUserPeer', $values, $con);
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
			$comparison = $criteria->getComparison(UserPeer::ID);
			$selectCriteria->add(UserPeer::ID, $criteria->remove(UserPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseUserPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseUserPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(UserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof User) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(User $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UserPeer::DATABASE_NAME, UserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $pk);


		$v = UserPeer::doSelect($criteria, $con);

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
			$criteria->add(UserPeer::ID, $pks, Criteria::IN);
			$objs = UserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/UserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UserMapBuilder');
}
