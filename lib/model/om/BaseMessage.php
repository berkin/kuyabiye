<?php


abstract class BaseMessage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $sender;


	
	protected $recipent;


	
	protected $sender_folder = 1;


	
	protected $recipent_folder = 0;


	
	protected $title;


	
	protected $body;


	
	protected $conversation;


	
	protected $read = 0;


	
	protected $created_at;

	
	protected $aUserRelatedBySender;

	
	protected $aUserRelatedByRecipent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getSender()
	{

		return $this->sender;
	}

	
	public function getRecipent()
	{

		return $this->recipent;
	}

	
	public function getSenderFolder()
	{

		return $this->sender_folder;
	}

	
	public function getRecipentFolder()
	{

		return $this->recipent_folder;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getConversation()
	{

		return $this->conversation;
	}

	
	public function getRead()
	{

		return $this->read;
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
			$this->modifiedColumns[] = MessagePeer::ID;
		}

	} 
	
	public function setSender($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sender !== $v) {
			$this->sender = $v;
			$this->modifiedColumns[] = MessagePeer::SENDER;
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
			$this->modifiedColumns[] = MessagePeer::RECIPENT;
		}

		if ($this->aUserRelatedByRecipent !== null && $this->aUserRelatedByRecipent->getId() !== $v) {
			$this->aUserRelatedByRecipent = null;
		}

	} 
	
	public function setSenderFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sender_folder !== $v || $v === 1) {
			$this->sender_folder = $v;
			$this->modifiedColumns[] = MessagePeer::SENDER_FOLDER;
		}

	} 
	
	public function setRecipentFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recipent_folder !== $v || $v === 0) {
			$this->recipent_folder = $v;
			$this->modifiedColumns[] = MessagePeer::RECIPENT_FOLDER;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = MessagePeer::TITLE;
		}

	} 
	
	public function setBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = MessagePeer::BODY;
		}

	} 
	
	public function setConversation($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->conversation !== $v) {
			$this->conversation = $v;
			$this->modifiedColumns[] = MessagePeer::CONVERSATION;
		}

	} 
	
	public function setRead($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->read !== $v || $v === 0) {
			$this->read = $v;
			$this->modifiedColumns[] = MessagePeer::READ;
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
			$this->modifiedColumns[] = MessagePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->sender = $rs->getInt($startcol + 1);

			$this->recipent = $rs->getInt($startcol + 2);

			$this->sender_folder = $rs->getInt($startcol + 3);

			$this->recipent_folder = $rs->getInt($startcol + 4);

			$this->title = $rs->getString($startcol + 5);

			$this->body = $rs->getString($startcol + 6);

			$this->conversation = $rs->getInt($startcol + 7);

			$this->read = $rs->getInt($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Message object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseMessage:delete:pre') as $callable)
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
			$con = Propel::getConnection(MessagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MessagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMessage:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseMessage:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(MessagePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MessagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMessage:save:post') as $callable)
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
					$pk = MessagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MessagePeer::doUpdate($this, $con);
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


			if (($retval = MessagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSender();
				break;
			case 2:
				return $this->getRecipent();
				break;
			case 3:
				return $this->getSenderFolder();
				break;
			case 4:
				return $this->getRecipentFolder();
				break;
			case 5:
				return $this->getTitle();
				break;
			case 6:
				return $this->getBody();
				break;
			case 7:
				return $this->getConversation();
				break;
			case 8:
				return $this->getRead();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MessagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSender(),
			$keys[2] => $this->getRecipent(),
			$keys[3] => $this->getSenderFolder(),
			$keys[4] => $this->getRecipentFolder(),
			$keys[5] => $this->getTitle(),
			$keys[6] => $this->getBody(),
			$keys[7] => $this->getConversation(),
			$keys[8] => $this->getRead(),
			$keys[9] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSender($value);
				break;
			case 2:
				$this->setRecipent($value);
				break;
			case 3:
				$this->setSenderFolder($value);
				break;
			case 4:
				$this->setRecipentFolder($value);
				break;
			case 5:
				$this->setTitle($value);
				break;
			case 6:
				$this->setBody($value);
				break;
			case 7:
				$this->setConversation($value);
				break;
			case 8:
				$this->setRead($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MessagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSender($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRecipent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSenderFolder($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRecipentFolder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTitle($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBody($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setConversation($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRead($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MessagePeer::DATABASE_NAME);

		if ($this->isColumnModified(MessagePeer::ID)) $criteria->add(MessagePeer::ID, $this->id);
		if ($this->isColumnModified(MessagePeer::SENDER)) $criteria->add(MessagePeer::SENDER, $this->sender);
		if ($this->isColumnModified(MessagePeer::RECIPENT)) $criteria->add(MessagePeer::RECIPENT, $this->recipent);
		if ($this->isColumnModified(MessagePeer::SENDER_FOLDER)) $criteria->add(MessagePeer::SENDER_FOLDER, $this->sender_folder);
		if ($this->isColumnModified(MessagePeer::RECIPENT_FOLDER)) $criteria->add(MessagePeer::RECIPENT_FOLDER, $this->recipent_folder);
		if ($this->isColumnModified(MessagePeer::TITLE)) $criteria->add(MessagePeer::TITLE, $this->title);
		if ($this->isColumnModified(MessagePeer::BODY)) $criteria->add(MessagePeer::BODY, $this->body);
		if ($this->isColumnModified(MessagePeer::CONVERSATION)) $criteria->add(MessagePeer::CONVERSATION, $this->conversation);
		if ($this->isColumnModified(MessagePeer::READ)) $criteria->add(MessagePeer::READ, $this->read);
		if ($this->isColumnModified(MessagePeer::CREATED_AT)) $criteria->add(MessagePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MessagePeer::DATABASE_NAME);

		$criteria->add(MessagePeer::ID, $this->id);

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

		$copyObj->setSender($this->sender);

		$copyObj->setRecipent($this->recipent);

		$copyObj->setSenderFolder($this->sender_folder);

		$copyObj->setRecipentFolder($this->recipent_folder);

		$copyObj->setTitle($this->title);

		$copyObj->setBody($this->body);

		$copyObj->setConversation($this->conversation);

		$copyObj->setRead($this->read);

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
			self::$peer = new MessagePeer();
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMessage:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMessage::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 