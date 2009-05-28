<?php


abstract class BaseConversation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $sender;


	
	protected $recipent;


	
	protected $is_replied = 0;


	
	protected $sender_is_replied = 0;


	
	protected $recipent_is_replied = 0;


	
	protected $sender_is_deleted = 0;


	
	protected $recipent_is_deleted = 0;


	
	protected $sender_is_read = 0;


	
	protected $recipent_is_read = 0;


	
	protected $updated_at;

	
	protected $aUserRelatedBySender;

	
	protected $aUserRelatedByRecipent;

	
	protected $collMessages;

	
	protected $lastMessageCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getSender()
	{

		return $this->sender;
	}

	
	public function getRecipent()
	{

		return $this->recipent;
	}

	
	public function getIsReplied()
	{

		return $this->is_replied;
	}

	
	public function getSenderIsReplied()
	{

		return $this->sender_is_replied;
	}

	
	public function getRecipentIsReplied()
	{

		return $this->recipent_is_replied;
	}

	
	public function getSenderIsDeleted()
	{

		return $this->sender_is_deleted;
	}

	
	public function getRecipentIsDeleted()
	{

		return $this->recipent_is_deleted;
	}

	
	public function getSenderIsRead()
	{

		return $this->sender_is_read;
	}

	
	public function getRecipentIsRead()
	{

		return $this->recipent_is_read;
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
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
			$this->modifiedColumns[] = ConversationPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ConversationPeer::TITLE;
		}

	} 
	
	public function setSender($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sender !== $v) {
			$this->sender = $v;
			$this->modifiedColumns[] = ConversationPeer::SENDER;
		}

		if ($this->aUserRelatedBySender !== null && $this->aUserRelatedBySender->getId() !== $v) {
			$this->aUserRelatedBySender = null;
		}

	} 
	
	public function setRecipent($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recipent !== $v) {
			$this->recipent = $v;
			$this->modifiedColumns[] = ConversationPeer::RECIPENT;
		}

		if ($this->aUserRelatedByRecipent !== null && $this->aUserRelatedByRecipent->getId() !== $v) {
			$this->aUserRelatedByRecipent = null;
		}

	} 
	
	public function setIsReplied($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_replied !== $v || $v === 0) {
			$this->is_replied = $v;
			$this->modifiedColumns[] = ConversationPeer::IS_REPLIED;
		}

	} 
	
	public function setSenderIsReplied($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sender_is_replied !== $v || $v === 0) {
			$this->sender_is_replied = $v;
			$this->modifiedColumns[] = ConversationPeer::SENDER_IS_REPLIED;
		}

	} 
	
	public function setRecipentIsReplied($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recipent_is_replied !== $v || $v === 0) {
			$this->recipent_is_replied = $v;
			$this->modifiedColumns[] = ConversationPeer::RECIPENT_IS_REPLIED;
		}

	} 
	
	public function setSenderIsDeleted($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sender_is_deleted !== $v || $v === 0) {
			$this->sender_is_deleted = $v;
			$this->modifiedColumns[] = ConversationPeer::SENDER_IS_DELETED;
		}

	} 
	
	public function setRecipentIsDeleted($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recipent_is_deleted !== $v || $v === 0) {
			$this->recipent_is_deleted = $v;
			$this->modifiedColumns[] = ConversationPeer::RECIPENT_IS_DELETED;
		}

	} 
	
	public function setSenderIsRead($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sender_is_read !== $v || $v === 0) {
			$this->sender_is_read = $v;
			$this->modifiedColumns[] = ConversationPeer::SENDER_IS_READ;
		}

	} 
	
	public function setRecipentIsRead($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recipent_is_read !== $v || $v === 0) {
			$this->recipent_is_read = $v;
			$this->modifiedColumns[] = ConversationPeer::RECIPENT_IS_READ;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ConversationPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->sender = $rs->getInt($startcol + 2);

			$this->recipent = $rs->getInt($startcol + 3);

			$this->is_replied = $rs->getInt($startcol + 4);

			$this->sender_is_replied = $rs->getInt($startcol + 5);

			$this->recipent_is_replied = $rs->getInt($startcol + 6);

			$this->sender_is_deleted = $rs->getInt($startcol + 7);

			$this->recipent_is_deleted = $rs->getInt($startcol + 8);

			$this->sender_is_read = $rs->getInt($startcol + 9);

			$this->recipent_is_read = $rs->getInt($startcol + 10);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Conversation object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseConversation:delete:pre') as $callable)
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
			$con = Propel::getConnection(ConversationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConversationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseConversation:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseConversation:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isModified() && !$this->isColumnModified(ConversationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConversationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseConversation:save:post') as $callable)
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


												
			if ($this->aUserRelatedBySender !== null) {
				if ($this->aUserRelatedBySender->isModified()) {
					$affectedRows += $this->aUserRelatedBySender->save($con);
				}
				$this->setUserRelatedBySender($this->aUserRelatedBySender);
			}

			if ($this->aUserRelatedByRecipent !== null) {
				if ($this->aUserRelatedByRecipent->isModified()) {
					$affectedRows += $this->aUserRelatedByRecipent->save($con);
				}
				$this->setUserRelatedByRecipent($this->aUserRelatedByRecipent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConversationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConversationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collMessages !== null) {
				foreach($this->collMessages as $referrerFK) {
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


												
			if ($this->aUserRelatedBySender !== null) {
				if (!$this->aUserRelatedBySender->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedBySender->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByRecipent !== null) {
				if (!$this->aUserRelatedByRecipent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByRecipent->getValidationFailures());
				}
			}


			if (($retval = ConversationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMessages !== null) {
					foreach($this->collMessages as $referrerFK) {
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
		$pos = ConversationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getSender();
				break;
			case 3:
				return $this->getRecipent();
				break;
			case 4:
				return $this->getIsReplied();
				break;
			case 5:
				return $this->getSenderIsReplied();
				break;
			case 6:
				return $this->getRecipentIsReplied();
				break;
			case 7:
				return $this->getSenderIsDeleted();
				break;
			case 8:
				return $this->getRecipentIsDeleted();
				break;
			case 9:
				return $this->getSenderIsRead();
				break;
			case 10:
				return $this->getRecipentIsRead();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConversationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getSender(),
			$keys[3] => $this->getRecipent(),
			$keys[4] => $this->getIsReplied(),
			$keys[5] => $this->getSenderIsReplied(),
			$keys[6] => $this->getRecipentIsReplied(),
			$keys[7] => $this->getSenderIsDeleted(),
			$keys[8] => $this->getRecipentIsDeleted(),
			$keys[9] => $this->getSenderIsRead(),
			$keys[10] => $this->getRecipentIsRead(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConversationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setSender($value);
				break;
			case 3:
				$this->setRecipent($value);
				break;
			case 4:
				$this->setIsReplied($value);
				break;
			case 5:
				$this->setSenderIsReplied($value);
				break;
			case 6:
				$this->setRecipentIsReplied($value);
				break;
			case 7:
				$this->setSenderIsDeleted($value);
				break;
			case 8:
				$this->setRecipentIsDeleted($value);
				break;
			case 9:
				$this->setSenderIsRead($value);
				break;
			case 10:
				$this->setRecipentIsRead($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConversationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSender($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRecipent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsReplied($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSenderIsReplied($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRecipentIsReplied($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSenderIsDeleted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRecipentIsDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSenderIsRead($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRecipentIsRead($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConversationPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConversationPeer::ID)) $criteria->add(ConversationPeer::ID, $this->id);
		if ($this->isColumnModified(ConversationPeer::TITLE)) $criteria->add(ConversationPeer::TITLE, $this->title);
		if ($this->isColumnModified(ConversationPeer::SENDER)) $criteria->add(ConversationPeer::SENDER, $this->sender);
		if ($this->isColumnModified(ConversationPeer::RECIPENT)) $criteria->add(ConversationPeer::RECIPENT, $this->recipent);
		if ($this->isColumnModified(ConversationPeer::IS_REPLIED)) $criteria->add(ConversationPeer::IS_REPLIED, $this->is_replied);
		if ($this->isColumnModified(ConversationPeer::SENDER_IS_REPLIED)) $criteria->add(ConversationPeer::SENDER_IS_REPLIED, $this->sender_is_replied);
		if ($this->isColumnModified(ConversationPeer::RECIPENT_IS_REPLIED)) $criteria->add(ConversationPeer::RECIPENT_IS_REPLIED, $this->recipent_is_replied);
		if ($this->isColumnModified(ConversationPeer::SENDER_IS_DELETED)) $criteria->add(ConversationPeer::SENDER_IS_DELETED, $this->sender_is_deleted);
		if ($this->isColumnModified(ConversationPeer::RECIPENT_IS_DELETED)) $criteria->add(ConversationPeer::RECIPENT_IS_DELETED, $this->recipent_is_deleted);
		if ($this->isColumnModified(ConversationPeer::SENDER_IS_READ)) $criteria->add(ConversationPeer::SENDER_IS_READ, $this->sender_is_read);
		if ($this->isColumnModified(ConversationPeer::RECIPENT_IS_READ)) $criteria->add(ConversationPeer::RECIPENT_IS_READ, $this->recipent_is_read);
		if ($this->isColumnModified(ConversationPeer::UPDATED_AT)) $criteria->add(ConversationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConversationPeer::DATABASE_NAME);

		$criteria->add(ConversationPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setSender($this->sender);

		$copyObj->setRecipent($this->recipent);

		$copyObj->setIsReplied($this->is_replied);

		$copyObj->setSenderIsReplied($this->sender_is_replied);

		$copyObj->setRecipentIsReplied($this->recipent_is_replied);

		$copyObj->setSenderIsDeleted($this->sender_is_deleted);

		$copyObj->setRecipentIsDeleted($this->recipent_is_deleted);

		$copyObj->setSenderIsRead($this->sender_is_read);

		$copyObj->setRecipentIsRead($this->recipent_is_read);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getMessages() as $relObj) {
				$copyObj->addMessage($relObj->copy($deepCopy));
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
			self::$peer = new ConversationPeer();
		}
		return self::$peer;
	}

	
	public function setUserRelatedBySender($v)
	{


		if ($v === null) {
			$this->setSender(NULL);
		} else {
			$this->setSender($v->getId());
		}


		$this->aUserRelatedBySender = $v;
	}


	
	public function getUserRelatedBySender($con = null)
	{
		if ($this->aUserRelatedBySender === null && ($this->sender !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedBySender = UserPeer::retrieveByPK($this->sender, $con);

			
		}
		return $this->aUserRelatedBySender;
	}

	
	public function setUserRelatedByRecipent($v)
	{


		if ($v === null) {
			$this->setRecipent(NULL);
		} else {
			$this->setRecipent($v->getId());
		}


		$this->aUserRelatedByRecipent = $v;
	}


	
	public function getUserRelatedByRecipent($con = null)
	{
		if ($this->aUserRelatedByRecipent === null && ($this->recipent !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByRecipent = UserPeer::retrieveByPK($this->recipent, $con);

			
		}
		return $this->aUserRelatedByRecipent;
	}

	
	public function initMessages()
	{
		if ($this->collMessages === null) {
			$this->collMessages = array();
		}
	}

	
	public function getMessages($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMessages === null) {
			if ($this->isNew()) {
			   $this->collMessages = array();
			} else {

				$criteria->add(MessagePeer::CONVERSATION_ID, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				$this->collMessages = MessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MessagePeer::CONVERSATION_ID, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastMessageCriteria) || !$this->lastMessageCriteria->equals($criteria)) {
					$this->collMessages = MessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMessageCriteria = $criteria;
		return $this->collMessages;
	}

	
	public function countMessages($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MessagePeer::CONVERSATION_ID, $this->getId());

		return MessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMessage(Message $l)
	{
		$this->collMessages[] = $l;
		$l->setConversation($this);
	}


	
	public function getMessagesJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMessages === null) {
			if ($this->isNew()) {
				$this->collMessages = array();
			} else {

				$criteria->add(MessagePeer::CONVERSATION_ID, $this->getId());

				$this->collMessages = MessagePeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(MessagePeer::CONVERSATION_ID, $this->getId());

			if (!isset($this->lastMessageCriteria) || !$this->lastMessageCriteria->equals($criteria)) {
				$this->collMessages = MessagePeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastMessageCriteria = $criteria;

		return $this->collMessages;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseConversation:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseConversation::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 