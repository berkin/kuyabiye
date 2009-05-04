<?php


abstract class BaseMessagePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'messages';

	
	const CLASS_DEFAULT = 'lib.model.Message';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'messages.ID';

	
	const SENDER = 'messages.SENDER';

	
	const RECIPENT = 'messages.RECIPENT';

	
	const SENDER_FOLDER = 'messages.SENDER_FOLDER';

	
	const RECIPENT_FOLDER = 'messages.RECIPENT_FOLDER';

	
	const TITLE = 'messages.TITLE';

	
	const BODY = 'messages.BODY';

	
	const CONVERSATION = 'messages.CONVERSATION';

	
	const READ = 'messages.READ';

	
	const CREATED_AT = 'messages.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Sender', 'Recipent', 'SenderFolder', 'RecipentFolder', 'Title', 'Body', 'Conversation', 'Read', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (MessagePeer::ID, MessagePeer::SENDER, MessagePeer::RECIPENT, MessagePeer::SENDER_FOLDER, MessagePeer::RECIPENT_FOLDER, MessagePeer::TITLE, MessagePeer::BODY, MessagePeer::CONVERSATION, MessagePeer::READ, MessagePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'sender', 'recipent', 'sender_folder', 'recipent_folder', 'title', 'body', 'conversation', 'read', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Sender' => 1, 'Recipent' => 2, 'SenderFolder' => 3, 'RecipentFolder' => 4, 'Title' => 5, 'Body' => 6, 'Conversation' => 7, 'Read' => 8, 'CreatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (MessagePeer::ID => 0, MessagePeer::SENDER => 1, MessagePeer::RECIPENT => 2, MessagePeer::SENDER_FOLDER => 3, MessagePeer::RECIPENT_FOLDER => 4, MessagePeer::TITLE => 5, MessagePeer::BODY => 6, MessagePeer::CONVERSATION => 7, MessagePeer::READ => 8, MessagePeer::CREATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'sender' => 1, 'recipent' => 2, 'sender_folder' => 3, 'recipent_folder' => 4, 'title' => 5, 'body' => 6, 'conversation' => 7, 'read' => 8, 'created_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MessageMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MessageMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MessagePeer::getTableMap();
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
		return str_replace(MessagePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MessagePeer::ID);

		$criteria->addSelectColumn(MessagePeer::SENDER);

		$criteria->addSelectColumn(MessagePeer::RECIPENT);

		$criteria->addSelectColumn(MessagePeer::SENDER_FOLDER);

		$criteria->addSelectColumn(MessagePeer::RECIPENT_FOLDER);

		$criteria->addSelectColumn(MessagePeer::TITLE);

		$criteria->addSelectColumn(MessagePeer::BODY);

		$criteria->addSelectColumn(MessagePeer::CONVERSATION);

		$criteria->addSelectColumn(MessagePeer::READ);

		$criteria->addSelectColumn(MessagePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(messages.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT messages.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MessagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MessagePeer::doSelectRS($criteria, $con);
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
		$objects = MessagePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MessagePeer::populateObjects(MessagePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMessagePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseMessagePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MessagePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MessagePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUserRelatedBySender(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MessagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MessagePeer::SENDER, UserPeer::ID);

		$rs = MessagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUserRelatedByRecipent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MessagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MessagePeer::RECIPENT, UserPeer::ID);

		$rs = MessagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUserRelatedBySender(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MessagePeer::addSelectColumns($c);
		$startcol = (MessagePeer::NUM_COLUMNS - MessagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(MessagePeer::SENDER, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MessagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedBySender(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMessageRelatedBySender($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMessagesRelatedBySender();
				$obj2->addMessageRelatedBySender($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUserRelatedByRecipent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MessagePeer::addSelectColumns($c);
		$startcol = (MessagePeer::NUM_COLUMNS - MessagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(MessagePeer::RECIPENT, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MessagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByRecipent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMessageRelatedByRecipent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMessagesRelatedByRecipent();
				$obj2->addMessageRelatedByRecipent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MessagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MessagePeer::SENDER, UserPeer::ID);

		$criteria->addJoin(MessagePeer::RECIPENT, UserPeer::ID);

		$rs = MessagePeer::doSelectRS($criteria, $con);
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

		MessagePeer::addSelectColumns($c);
		$startcol2 = (MessagePeer::NUM_COLUMNS - MessagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		$c->addJoin(MessagePeer::SENDER, UserPeer::ID);

		$c->addJoin(MessagePeer::RECIPENT, UserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MessagePeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUserRelatedBySender(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMessageRelatedBySender($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMessagesRelatedBySender();
				$obj2->addMessageRelatedBySender($obj1);
			}


					
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByRecipent(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMessageRelatedByRecipent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initMessagesRelatedByRecipent();
				$obj3->addMessageRelatedByRecipent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUserRelatedBySender(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MessagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MessagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUserRelatedByRecipent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MessagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MessagePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUserRelatedBySender(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MessagePeer::addSelectColumns($c);
		$startcol2 = (MessagePeer::NUM_COLUMNS - MessagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MessagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUserRelatedByRecipent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MessagePeer::addSelectColumns($c);
		$startcol2 = (MessagePeer::NUM_COLUMNS - MessagePeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MessagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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
		return MessagePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMessagePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMessagePeer', $values, $con);
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

		$criteria->remove(MessagePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseMessagePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseMessagePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMessagePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMessagePeer', $values, $con);
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
			$comparison = $criteria->getComparison(MessagePeer::ID);
			$selectCriteria->add(MessagePeer::ID, $criteria->remove(MessagePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseMessagePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseMessagePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(MessagePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MessagePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Message) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MessagePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Message $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MessagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MessagePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MessagePeer::DATABASE_NAME, MessagePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MessagePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(MessagePeer::DATABASE_NAME);

		$criteria->add(MessagePeer::ID, $pk);


		$v = MessagePeer::doSelect($criteria, $con);

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
			$criteria->add(MessagePeer::ID, $pks, Criteria::IN);
			$objs = MessagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseMessagePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/MessageMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MessageMapBuilder');
}
