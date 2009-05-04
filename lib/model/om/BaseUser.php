<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nickname;


	
	protected $email;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $remember_key;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $created_at;

	
	protected $collFriendsRelatedByUserFrom;

	
	protected $lastFriendRelatedByUserFromCriteria = null;

	
	protected $collFriendsRelatedByUserTo;

	
	protected $lastFriendRelatedByUserToCriteria = null;

	
	protected $collTags;

	
	protected $lastTagCriteria = null;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
	protected $collUserToTags;

	
	protected $lastUserToTagCriteria = null;

	
	protected $collMessagesRelatedBySender;

	
	protected $lastMessageRelatedBySenderCriteria = null;

	
	protected $collMessagesRelatedByRecipent;

	
	protected $lastMessageRelatedByRecipentCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNickname()
	{

		return $this->nickname;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getRememberKey()
	{

		return $this->remember_key;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
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
			$this->modifiedColumns[] = UserPeer::ID;
		}

	} 
	
	public function setNickname($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nickname !== $v) {
			$this->nickname = $v;
			$this->modifiedColumns[] = UserPeer::NICKNAME;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

	} 
	
	public function setSha1Password($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = UserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = UserPeer::SALT;
		}

	} 
	
	public function setRememberKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->remember_key !== $v) {
			$this->remember_key = $v;
			$this->modifiedColumns[] = UserPeer::REMEMBER_KEY;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
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
			$this->modifiedColumns[] = UserPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->nickname = $rs->getString($startcol + 1);

			$this->email = $rs->getString($startcol + 2);

			$this->sha1_password = $rs->getString($startcol + 3);

			$this->salt = $rs->getString($startcol + 4);

			$this->remember_key = $rs->getString($startcol + 5);

			$this->first_name = $rs->getString($startcol + 6);

			$this->last_name = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseUser:delete:pre') as $callable)
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUser:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseUser:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUser:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collFriendsRelatedByUserFrom !== null) {
				foreach($this->collFriendsRelatedByUserFrom as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendsRelatedByUserTo !== null) {
				foreach($this->collFriendsRelatedByUserTo as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTags !== null) {
				foreach($this->collTags as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collComments !== null) {
				foreach($this->collComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserToTags !== null) {
				foreach($this->collUserToTags as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMessagesRelatedBySender !== null) {
				foreach($this->collMessagesRelatedBySender as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMessagesRelatedByRecipent !== null) {
				foreach($this->collMessagesRelatedByRecipent as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFriendsRelatedByUserFrom !== null) {
					foreach($this->collFriendsRelatedByUserFrom as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendsRelatedByUserTo !== null) {
					foreach($this->collFriendsRelatedByUserTo as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTags !== null) {
					foreach($this->collTags as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collComments !== null) {
					foreach($this->collComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserToTags !== null) {
					foreach($this->collUserToTags as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMessagesRelatedBySender !== null) {
					foreach($this->collMessagesRelatedBySender as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMessagesRelatedByRecipent !== null) {
					foreach($this->collMessagesRelatedByRecipent as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNickname();
				break;
			case 2:
				return $this->getEmail();
				break;
			case 3:
				return $this->getSha1Password();
				break;
			case 4:
				return $this->getSalt();
				break;
			case 5:
				return $this->getRememberKey();
				break;
			case 6:
				return $this->getFirstName();
				break;
			case 7:
				return $this->getLastName();
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
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNickname(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getSha1Password(),
			$keys[4] => $this->getSalt(),
			$keys[5] => $this->getRememberKey(),
			$keys[6] => $this->getFirstName(),
			$keys[7] => $this->getLastName(),
			$keys[8] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNickname($value);
				break;
			case 2:
				$this->setEmail($value);
				break;
			case 3:
				$this->setSha1Password($value);
				break;
			case 4:
				$this->setSalt($value);
				break;
			case 5:
				$this->setRememberKey($value);
				break;
			case 6:
				$this->setFirstName($value);
				break;
			case 7:
				$this->setLastName($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNickname($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSha1Password($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSalt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRememberKey($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFirstName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLastName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::NICKNAME)) $criteria->add(UserPeer::NICKNAME, $this->nickname);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::SHA1_PASSWORD)) $criteria->add(UserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(UserPeer::SALT)) $criteria->add(UserPeer::SALT, $this->salt);
		if ($this->isColumnModified(UserPeer::REMEMBER_KEY)) $criteria->add(UserPeer::REMEMBER_KEY, $this->remember_key);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

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

		$copyObj->setNickname($this->nickname);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setRememberKey($this->remember_key);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFriendsRelatedByUserFrom() as $relObj) {
				$copyObj->addFriendRelatedByUserFrom($relObj->copy($deepCopy));
			}

			foreach($this->getFriendsRelatedByUserTo() as $relObj) {
				$copyObj->addFriendRelatedByUserTo($relObj->copy($deepCopy));
			}

			foreach($this->getTags() as $relObj) {
				$copyObj->addTag($relObj->copy($deepCopy));
			}

			foreach($this->getComments() as $relObj) {
				$copyObj->addComment($relObj->copy($deepCopy));
			}

			foreach($this->getUserToTags() as $relObj) {
				$copyObj->addUserToTag($relObj->copy($deepCopy));
			}

			foreach($this->getMessagesRelatedBySender() as $relObj) {
				$copyObj->addMessageRelatedBySender($relObj->copy($deepCopy));
			}

			foreach($this->getMessagesRelatedByRecipent() as $relObj) {
				$copyObj->addMessageRelatedByRecipent($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	
	public function initFriendsRelatedByUserFrom()
	{
		if ($this->collFriendsRelatedByUserFrom === null) {
			$this->collFriendsRelatedByUserFrom = array();
		}
	}

	
	public function getFriendsRelatedByUserFrom($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendsRelatedByUserFrom === null) {
			if ($this->isNew()) {
			   $this->collFriendsRelatedByUserFrom = array();
			} else {

				$criteria->add(FriendPeer::USER_FROM, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				$this->collFriendsRelatedByUserFrom = FriendPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendPeer::USER_FROM, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendRelatedByUserFromCriteria) || !$this->lastFriendRelatedByUserFromCriteria->equals($criteria)) {
					$this->collFriendsRelatedByUserFrom = FriendPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendRelatedByUserFromCriteria = $criteria;
		return $this->collFriendsRelatedByUserFrom;
	}

	
	public function countFriendsRelatedByUserFrom($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendPeer::USER_FROM, $this->getId());

		return FriendPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendRelatedByUserFrom(Friend $l)
	{
		$this->collFriendsRelatedByUserFrom[] = $l;
		$l->setUserRelatedByUserFrom($this);
	}

	
	public function initFriendsRelatedByUserTo()
	{
		if ($this->collFriendsRelatedByUserTo === null) {
			$this->collFriendsRelatedByUserTo = array();
		}
	}

	
	public function getFriendsRelatedByUserTo($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendsRelatedByUserTo === null) {
			if ($this->isNew()) {
			   $this->collFriendsRelatedByUserTo = array();
			} else {

				$criteria->add(FriendPeer::USER_TO, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				$this->collFriendsRelatedByUserTo = FriendPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendPeer::USER_TO, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendRelatedByUserToCriteria) || !$this->lastFriendRelatedByUserToCriteria->equals($criteria)) {
					$this->collFriendsRelatedByUserTo = FriendPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendRelatedByUserToCriteria = $criteria;
		return $this->collFriendsRelatedByUserTo;
	}

	
	public function countFriendsRelatedByUserTo($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendPeer::USER_TO, $this->getId());

		return FriendPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendRelatedByUserTo(Friend $l)
	{
		$this->collFriendsRelatedByUserTo[] = $l;
		$l->setUserRelatedByUserTo($this);
	}

	
	public function initTags()
	{
		if ($this->collTags === null) {
			$this->collTags = array();
		}
	}

	
	public function getTags($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTags === null) {
			if ($this->isNew()) {
			   $this->collTags = array();
			} else {

				$criteria->add(TagPeer::CREATED_BY, $this->getId());

				TagPeer::addSelectColumns($criteria);
				$this->collTags = TagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TagPeer::CREATED_BY, $this->getId());

				TagPeer::addSelectColumns($criteria);
				if (!isset($this->lastTagCriteria) || !$this->lastTagCriteria->equals($criteria)) {
					$this->collTags = TagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTagCriteria = $criteria;
		return $this->collTags;
	}

	
	public function countTags($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TagPeer::CREATED_BY, $this->getId());

		return TagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTag(Tag $l)
	{
		$this->collTags[] = $l;
		$l->setUser($this);
	}

	
	public function initComments()
	{
		if ($this->collComments === null) {
			$this->collComments = array();
		}
	}

	
	public function getComments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComments === null) {
			if ($this->isNew()) {
			   $this->collComments = array();
			} else {

				$criteria->add(CommentPeer::USERS_ID, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				$this->collComments = CommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommentPeer::USERS_ID, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
					$this->collComments = CommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCommentCriteria = $criteria;
		return $this->collComments;
	}

	
	public function countComments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CommentPeer::USERS_ID, $this->getId());

		return CommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComment(Comment $l)
	{
		$this->collComments[] = $l;
		$l->setUser($this);
	}


	
	public function getCommentsJoinTag($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComments === null) {
			if ($this->isNew()) {
				$this->collComments = array();
			} else {

				$criteria->add(CommentPeer::USERS_ID, $this->getId());

				$this->collComments = CommentPeer::doSelectJoinTag($criteria, $con);
			}
		} else {
									
			$criteria->add(CommentPeer::USERS_ID, $this->getId());

			if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
				$this->collComments = CommentPeer::doSelectJoinTag($criteria, $con);
			}
		}
		$this->lastCommentCriteria = $criteria;

		return $this->collComments;
	}

	
	public function initUserToTags()
	{
		if ($this->collUserToTags === null) {
			$this->collUserToTags = array();
		}
	}

	
	public function getUserToTags($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserToTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserToTags === null) {
			if ($this->isNew()) {
			   $this->collUserToTags = array();
			} else {

				$criteria->add(UserToTagPeer::USERS_ID, $this->getId());

				UserToTagPeer::addSelectColumns($criteria);
				$this->collUserToTags = UserToTagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserToTagPeer::USERS_ID, $this->getId());

				UserToTagPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserToTagCriteria) || !$this->lastUserToTagCriteria->equals($criteria)) {
					$this->collUserToTags = UserToTagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserToTagCriteria = $criteria;
		return $this->collUserToTags;
	}

	
	public function countUserToTags($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserToTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserToTagPeer::USERS_ID, $this->getId());

		return UserToTagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserToTag(UserToTag $l)
	{
		$this->collUserToTags[] = $l;
		$l->setUser($this);
	}


	
	public function getUserToTagsJoinTag($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserToTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserToTags === null) {
			if ($this->isNew()) {
				$this->collUserToTags = array();
			} else {

				$criteria->add(UserToTagPeer::USERS_ID, $this->getId());

				$this->collUserToTags = UserToTagPeer::doSelectJoinTag($criteria, $con);
			}
		} else {
									
			$criteria->add(UserToTagPeer::USERS_ID, $this->getId());

			if (!isset($this->lastUserToTagCriteria) || !$this->lastUserToTagCriteria->equals($criteria)) {
				$this->collUserToTags = UserToTagPeer::doSelectJoinTag($criteria, $con);
			}
		}
		$this->lastUserToTagCriteria = $criteria;

		return $this->collUserToTags;
	}

	
	public function initMessagesRelatedBySender()
	{
		if ($this->collMessagesRelatedBySender === null) {
			$this->collMessagesRelatedBySender = array();
		}
	}

	
	public function getMessagesRelatedBySender($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMessagesRelatedBySender === null) {
			if ($this->isNew()) {
			   $this->collMessagesRelatedBySender = array();
			} else {

				$criteria->add(MessagePeer::SENDER, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				$this->collMessagesRelatedBySender = MessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MessagePeer::SENDER, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastMessageRelatedBySenderCriteria) || !$this->lastMessageRelatedBySenderCriteria->equals($criteria)) {
					$this->collMessagesRelatedBySender = MessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMessageRelatedBySenderCriteria = $criteria;
		return $this->collMessagesRelatedBySender;
	}

	
	public function countMessagesRelatedBySender($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MessagePeer::SENDER, $this->getId());

		return MessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMessageRelatedBySender(Message $l)
	{
		$this->collMessagesRelatedBySender[] = $l;
		$l->setUserRelatedBySender($this);
	}

	
	public function initMessagesRelatedByRecipent()
	{
		if ($this->collMessagesRelatedByRecipent === null) {
			$this->collMessagesRelatedByRecipent = array();
		}
	}

	
	public function getMessagesRelatedByRecipent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMessagesRelatedByRecipent === null) {
			if ($this->isNew()) {
			   $this->collMessagesRelatedByRecipent = array();
			} else {

				$criteria->add(MessagePeer::RECIPENT, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				$this->collMessagesRelatedByRecipent = MessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MessagePeer::RECIPENT, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastMessageRelatedByRecipentCriteria) || !$this->lastMessageRelatedByRecipentCriteria->equals($criteria)) {
					$this->collMessagesRelatedByRecipent = MessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMessageRelatedByRecipentCriteria = $criteria;
		return $this->collMessagesRelatedByRecipent;
	}

	
	public function countMessagesRelatedByRecipent($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MessagePeer::RECIPENT, $this->getId());

		return MessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMessageRelatedByRecipent(Message $l)
	{
		$this->collMessagesRelatedByRecipent[] = $l;
		$l->setUserRelatedByRecipent($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 