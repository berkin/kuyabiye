<?php


abstract class BaseTagComment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $tags_id;


	
	protected $users_id;


	
	protected $body;


	
	protected $tree_left;


	
	protected $tree_right;


	
	protected $tree_parent;


	
	protected $scope;


	
	protected $created_at;

	
	protected $aTag;

	
	protected $aUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTagsId()
	{

		return $this->tags_id;
	}

	
	public function getUsersId()
	{

		return $this->users_id;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getTreeLeft()
	{

		return $this->tree_left;
	}

	
	public function getTreeRight()
	{

		return $this->tree_right;
	}

	
	public function getTreeParent()
	{

		return $this->tree_parent;
	}

	
	public function getScope()
	{

		return $this->scope;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TagCommentPeer::ID;
		}

	} 
	
	public function setTagsId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tags_id !== $v) {
			$this->tags_id = $v;
			$this->modifiedColumns[] = TagCommentPeer::TAGS_ID;
		}

		if ($this->aTag !== null && $this->aTag->getId() !== $v) {
			$this->aTag = null;
		}

	} 
	
	public function setUsersId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->users_id !== $v) {
			$this->users_id = $v;
			$this->modifiedColumns[] = TagCommentPeer::USERS_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = TagCommentPeer::BODY;
		}

	} 
	
	public function setTreeLeft($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left !== $v) {
			$this->tree_left = $v;
			$this->modifiedColumns[] = TagCommentPeer::TREE_LEFT;
		}

	} 
	
	public function setTreeRight($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right !== $v) {
			$this->tree_right = $v;
			$this->modifiedColumns[] = TagCommentPeer::TREE_RIGHT;
		}

	} 
	
	public function setTreeParent($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent !== $v) {
			$this->tree_parent = $v;
			$this->modifiedColumns[] = TagCommentPeer::TREE_PARENT;
		}

	} 
	
	public function setScope($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scope !== $v) {
			$this->scope = $v;
			$this->modifiedColumns[] = TagCommentPeer::SCOPE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = TagCommentPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->tags_id = $rs->getInt($startcol + 1);

			$this->users_id = $rs->getInt($startcol + 2);

			$this->body = $rs->getString($startcol + 3);

			$this->tree_left = $rs->getInt($startcol + 4);

			$this->tree_right = $rs->getInt($startcol + 5);

			$this->tree_parent = $rs->getInt($startcol + 6);

			$this->scope = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TagComment object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseTagComment:delete:pre') as $callable)
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
			$con = Propel::getConnection(TagCommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TagCommentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTagComment:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseTagComment:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(TagCommentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TagCommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTagComment:save:post') as $callable)
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


												
			if ($this->aTag !== null) {
				if ($this->aTag->isModified()) {
					$affectedRows += $this->aTag->save($con);
				}
				$this->setTag($this->aTag);
			}

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TagCommentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TagCommentPeer::doUpdate($this, $con);
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


												
			if ($this->aTag !== null) {
				if (!$this->aTag->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTag->getValidationFailures());
				}
			}

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = TagCommentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTagsId();
				break;
			case 2:
				return $this->getUsersId();
				break;
			case 3:
				return $this->getBody();
				break;
			case 4:
				return $this->getTreeLeft();
				break;
			case 5:
				return $this->getTreeRight();
				break;
			case 6:
				return $this->getTreeParent();
				break;
			case 7:
				return $this->getScope();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagCommentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTagsId(),
			$keys[2] => $this->getUsersId(),
			$keys[3] => $this->getBody(),
			$keys[4] => $this->getTreeLeft(),
			$keys[5] => $this->getTreeRight(),
			$keys[6] => $this->getTreeParent(),
			$keys[7] => $this->getScope(),
			$keys[8] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTagsId($value);
				break;
			case 2:
				$this->setUsersId($value);
				break;
			case 3:
				$this->setBody($value);
				break;
			case 4:
				$this->setTreeLeft($value);
				break;
			case 5:
				$this->setTreeRight($value);
				break;
			case 6:
				$this->setTreeParent($value);
				break;
			case 7:
				$this->setScope($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagCommentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTagsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUsersId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTreeLeft($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTreeRight($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTreeParent($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setScope($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TagCommentPeer::DATABASE_NAME);

		if ($this->isColumnModified(TagCommentPeer::ID)) $criteria->add(TagCommentPeer::ID, $this->id);
		if ($this->isColumnModified(TagCommentPeer::TAGS_ID)) $criteria->add(TagCommentPeer::TAGS_ID, $this->tags_id);
		if ($this->isColumnModified(TagCommentPeer::USERS_ID)) $criteria->add(TagCommentPeer::USERS_ID, $this->users_id);
		if ($this->isColumnModified(TagCommentPeer::BODY)) $criteria->add(TagCommentPeer::BODY, $this->body);
		if ($this->isColumnModified(TagCommentPeer::TREE_LEFT)) $criteria->add(TagCommentPeer::TREE_LEFT, $this->tree_left);
		if ($this->isColumnModified(TagCommentPeer::TREE_RIGHT)) $criteria->add(TagCommentPeer::TREE_RIGHT, $this->tree_right);
		if ($this->isColumnModified(TagCommentPeer::TREE_PARENT)) $criteria->add(TagCommentPeer::TREE_PARENT, $this->tree_parent);
		if ($this->isColumnModified(TagCommentPeer::SCOPE)) $criteria->add(TagCommentPeer::SCOPE, $this->scope);
		if ($this->isColumnModified(TagCommentPeer::CREATED_AT)) $criteria->add(TagCommentPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TagCommentPeer::DATABASE_NAME);

		$criteria->add(TagCommentPeer::ID, $this->id);

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

		$copyObj->setTagsId($this->tags_id);

		$copyObj->setUsersId($this->users_id);

		$copyObj->setBody($this->body);

		$copyObj->setTreeLeft($this->tree_left);

		$copyObj->setTreeRight($this->tree_right);

		$copyObj->setTreeParent($this->tree_parent);

		$copyObj->setScope($this->scope);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new TagCommentPeer();
		}
		return self::$peer;
	}

	
	public function setTag($v)
	{


		if ($v === null) {
			$this->setTagsId(NULL);
		} else {
			$this->setTagsId($v->getId());
		}


		$this->aTag = $v;
	}


	
	public function getTag($con = null)
	{
		if ($this->aTag === null && ($this->tags_id !== null)) {
						include_once 'lib/model/om/BaseTagPeer.php';

			$this->aTag = TagPeer::retrieveByPK($this->tags_id, $con);

			
		}
		return $this->aTag;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUsersId(NULL);
		} else {
			$this->setUsersId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && ($this->users_id !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->users_id, $con);

			
		}
		return $this->aUser;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTagComment:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTagComment::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 