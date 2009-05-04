<?php


abstract class BaseFriend extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_from;


	
	protected $user_to;


	
	protected $status;

	
	protected $aUserRelatedByUserFrom;

	
	protected $aUserRelatedByUserTo;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserFrom()
	{

		return $this->user_from;
	}

	
	public function getUserTo()
	{

		return $this->user_to;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FriendPeer::ID;
		}

	} 
	
	public function setUserFrom($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_from !== $v) {
			$this->user_from = $v;
			$this->modifiedColumns[] = FriendPeer::USER_FROM;
		}

		if ($this->aUserRelatedByUserFrom !== null && $this->aUserRelatedByUserFrom->getId() !== $v) {
			$this->aUserRelatedByUserFrom = null;
		}

	} 
	
	public function setUserTo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_to !== $v) {
			$this->user_to = $v;
			$this->modifiedColumns[] = FriendPeer::USER_TO;
		}

		if ($this->aUserRelatedByUserTo !== null && $this->aUserRelatedByUserTo->getId() !== $v) {
			$this->aUserRelatedByUserTo = null;
		}

	} 
	
	public function setStatus($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = FriendPeer::STATUS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_from = $rs->getInt($startcol + 1);

			$this->user_to = $rs->getInt($startcol + 2);

			$this->status = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Friend object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseFriend:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FriendPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FriendPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFriend:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseFriend:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FriendPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFriend:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aUserRelatedByUserFrom !== null) {
				if ($this->aUserRelatedByUserFrom->isModified()) {
					$affectedRows += $this->aUserRelatedByUserFrom->save($con);
				}
				$this->setUserRelatedByUserFrom($this->aUserRelatedByUserFrom);
			}

			if ($this->aUserRelatedByUserTo !== null) {
				if ($this->aUserRelatedByUserTo->isModified()) {
					$affectedRows += $this->aUserRelatedByUserTo->save($con);
				}
				$this->setUserRelatedByUserTo($this->aUserRelatedByUserTo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FriendPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FriendPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aUserRelatedByUserFrom !== null) {
				if (!$this->aUserRelatedByUserFrom->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByUserFrom->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByUserTo !== null) {
				if (!$this->aUserRelatedByUserTo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByUserTo->getValidationFailures());
				}
			}


			if (($retval = FriendPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FriendPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserFrom();
				break;
			case 2:
				return $this->getUserTo();
				break;
			case 3:
				return $this->getStatus();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FriendPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserFrom(),
			$keys[2] => $this->getUserTo(),
			$keys[3] => $this->getStatus(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FriendPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserFrom($value);
				break;
			case 2:
				$this->setUserTo($value);
				break;
			case 3:
				$this->setStatus($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FriendPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserFrom($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserTo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStatus($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FriendPeer::DATABASE_NAME);

		if ($this->isColumnModified(FriendPeer::ID)) $criteria->add(FriendPeer::ID, $this->id);
		if ($this->isColumnModified(FriendPeer::USER_FROM)) $criteria->add(FriendPeer::USER_FROM, $this->user_from);
		if ($this->isColumnModified(FriendPeer::USER_TO)) $criteria->add(FriendPeer::USER_TO, $this->user_to);
		if ($this->isColumnModified(FriendPeer::STATUS)) $criteria->add(FriendPeer::STATUS, $this->status);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FriendPeer::DATABASE_NAME);

		$criteria->add(FriendPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserFrom($this->user_from);

		$copyObj->setUserTo($this->user_to);

		$copyObj->setStatus($this->status);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FriendPeer();
		}
		return self::$peer;
	}

	
	public function setUserRelatedByUserFrom($v)
	{


		if ($v === null) {
			$this->setUserFrom(NULL);
		} else {
			$this->setUserFrom($v->getId());
		}


		$this->aUserRelatedByUserFrom = $v;
	}


	
	public function getUserRelatedByUserFrom($con = null)
	{
		if ($this->aUserRelatedByUserFrom === null && ($this->user_from !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByUserFrom = UserPeer::retrieveByPK($this->user_from, $con);

			
		}
		return $this->aUserRelatedByUserFrom;
	}

	
	public function setUserRelatedByUserTo($v)
	{


		if ($v === null) {
			$this->setUserTo(NULL);
		} else {
			$this->setUserTo($v->getId());
		}


		$this->aUserRelatedByUserTo = $v;
	}


	
	public function getUserRelatedByUserTo($con = null)
	{
		if ($this->aUserRelatedByUserTo === null && ($this->user_to !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByUserTo = UserPeer::retrieveByPK($this->user_to, $con);

			
		}
		return $this->aUserRelatedByUserTo;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFriend:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFriend::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 