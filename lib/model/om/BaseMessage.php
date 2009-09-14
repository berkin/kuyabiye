<?php


abstract class BaseMessage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $conversation_id;


	
	protected $writer;


	
	protected $body;


	
	protected $html_body;


	
	protected $read = 0;


	
	protected $created_at;

	
	protected $aConversation;

	
	protected $aUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getConversationId()
	{

		return $this->conversation_id;
	}

	
	public function getWriter()
	{

		return $this->writer;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getHtmlBody()
	{

		return $this->html_body;
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
	
	public function setConversationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->conversation_id !== $v) {
			$this->conversation_id = $v;
			$this->modifiedColumns[] = MessagePeer::CONVERSATION_ID;
		}

		if ($this->aConversation !== null && $this->aConversation->getConversation() !== $v) {
			$this->aConversation = null;
		}

	} 
	
	public function setWriter($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->writer !== $v) {
			$this->writer = $v;
			$this->modifiedColumns[] = MessagePeer::WRITER;
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
			$this->modifiedColumns[] = MessagePeer::BODY;
		}

	} 
	
	public function setHtmlBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->html_body !== $v) {
			$this->html_body = $v;
			$this->modifiedColumns[] = MessagePeer::HTML_BODY;
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

			$this->conversation_id = $rs->getInt($startcol + 1);

			$this->writer = $rs->getInt($startcol + 2);

			$this->body = $rs->getString($startcol + 3);

			$this->html_body = $rs->getString($startcol + 4);

			$this->read = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
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


												
			if ($this->aConversation !== null) {
				if ($this->aConversation->isModified()) {
					$affectedRows += $this->aConversation->save($con);
				}
				$this->setConversation($this->aConversation);
			}

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
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


												
			if ($this->aConversation !== null) {
				if (!$this->aConversation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConversation->getValidationFailures());
				}
			}

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
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
				return $this->getConversationId();
				break;
			case 2:
				return $this->getWriter();
				break;
			case 3:
				return $this->getBody();
				break;
			case 4:
				return $this->getHtmlBody();
				break;
			case 5:
				return $this->getRead();
				break;
			case 6:
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
			$keys[1] => $this->getConversationId(),
			$keys[2] => $this->getWriter(),
			$keys[3] => $this->getBody(),
			$keys[4] => $this->getHtmlBody(),
			$keys[5] => $this->getRead(),
			$keys[6] => $this->getCreatedAt(),
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
				$this->setConversationId($value);
				break;
			case 2:
				$this->setWriter($value);
				break;
			case 3:
				$this->setBody($value);
				break;
			case 4:
				$this->setHtmlBody($value);
				break;
			case 5:
				$this->setRead($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MessagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setConversationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWriter($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHtmlBody($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRead($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MessagePeer::DATABASE_NAME);

		if ($this->isColumnModified(MessagePeer::ID)) $criteria->add(MessagePeer::ID, $this->id);
		if ($this->isColumnModified(MessagePeer::CONVERSATION_ID)) $criteria->add(MessagePeer::CONVERSATION_ID, $this->conversation_id);
		if ($this->isColumnModified(MessagePeer::WRITER)) $criteria->add(MessagePeer::WRITER, $this->writer);
		if ($this->isColumnModified(MessagePeer::BODY)) $criteria->add(MessagePeer::BODY, $this->body);
		if ($this->isColumnModified(MessagePeer::HTML_BODY)) $criteria->add(MessagePeer::HTML_BODY, $this->html_body);
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

		$copyObj->setConversationId($this->conversation_id);

		$copyObj->setWriter($this->writer);

		$copyObj->setBody($this->body);

		$copyObj->setHtmlBody($this->html_body);

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

	
	public function setConversation($v)
	{


		if ($v === null) {
			$this->setConversationId(NULL);
		} else {
			$this->setConversationId($v->getConversation());
		}


		$this->aConversation = $v;
	}


	
	public function getConversation($con = null)
	{
		if ($this->aConversation === null && ($this->conversation_id !== null)) {
						include_once 'lib/model/om/BaseConversationPeer.php';

			$this->aConversation = ConversationPeer::retrieveByPK($this->conversation_id, $con);

			
		}
		return $this->aConversation;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setWriter(NULL);
		} else {
			$this->setWriter($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && ($this->writer !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->writer, $con);

			
		}
		return $this->aUser;
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