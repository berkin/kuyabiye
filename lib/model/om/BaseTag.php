<?php


abstract class BaseTag extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $tag;


	
	protected $stripped_tag;


	
	protected $created_by;


	
	protected $lovers = 0;


	
	protected $haters = 0;


	
	protected $lover_girls = 0;


	
	protected $hater_girls = 0;


	
	protected $nb_comments = 0;


	
	protected $love;


	
	protected $sticky;


	
	protected $is_on_homepage = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUser;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
	protected $collUserToTags;

	
	protected $lastUserToTagCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTag()
	{

		return $this->tag;
	}

	
	public function getStrippedTag()
	{

		return $this->stripped_tag;
	}

	
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	
	public function getLovers()
	{

		return $this->lovers;
	}

	
	public function getHaters()
	{

		return $this->haters;
	}

	
	public function getLoverGirls()
	{

		return $this->lover_girls;
	}

	
	public function getHaterGirls()
	{

		return $this->hater_girls;
	}

	
	public function getNbComments()
	{

		return $this->nb_comments;
	}

	
	public function getLove()
	{

		return $this->love;
	}

	
	public function getSticky()
	{

		return $this->sticky;
	}

	
	public function getIsOnHomepage()
	{

		return $this->is_on_homepage;
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
			$this->modifiedColumns[] = TagPeer::ID;
		}

	} 
	
	public function setTag($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag !== $v) {
			$this->tag = $v;
			$this->modifiedColumns[] = TagPeer::TAG;
		}

	} 
	
	public function setStrippedTag($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped_tag !== $v) {
			$this->stripped_tag = $v;
			$this->modifiedColumns[] = TagPeer::STRIPPED_TAG;
		}

	} 
	
	public function setCreatedBy($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = TagPeer::CREATED_BY;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setLovers($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->lovers !== $v || $v === 0) {
			$this->lovers = $v;
			$this->modifiedColumns[] = TagPeer::LOVERS;
		}

	} 
	
	public function setHaters($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->haters !== $v || $v === 0) {
			$this->haters = $v;
			$this->modifiedColumns[] = TagPeer::HATERS;
		}

	} 
	
	public function setLoverGirls($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->lover_girls !== $v || $v === 0) {
			$this->lover_girls = $v;
			$this->modifiedColumns[] = TagPeer::LOVER_GIRLS;
		}

	} 
	
	public function setHaterGirls($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->hater_girls !== $v || $v === 0) {
			$this->hater_girls = $v;
			$this->modifiedColumns[] = TagPeer::HATER_GIRLS;
		}

	} 
	
	public function setNbComments($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->nb_comments !== $v || $v === 0) {
			$this->nb_comments = $v;
			$this->modifiedColumns[] = TagPeer::NB_COMMENTS;
		}

	} 
	
	public function setLove($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->love !== $v) {
			$this->love = $v;
			$this->modifiedColumns[] = TagPeer::LOVE;
		}

	} 
	
	public function setSticky($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sticky !== $v) {
			$this->sticky = $v;
			$this->modifiedColumns[] = TagPeer::STICKY;
		}

	} 
	
	public function setIsOnHomepage($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_on_homepage !== $v || $v === 0) {
			$this->is_on_homepage = $v;
			$this->modifiedColumns[] = TagPeer::IS_ON_HOMEPAGE;
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
			$this->modifiedColumns[] = TagPeer::CREATED_AT;
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
			$this->modifiedColumns[] = TagPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->tag = $rs->getString($startcol + 1);

			$this->stripped_tag = $rs->getString($startcol + 2);

			$this->created_by = $rs->getInt($startcol + 3);

			$this->lovers = $rs->getInt($startcol + 4);

			$this->haters = $rs->getInt($startcol + 5);

			$this->lover_girls = $rs->getInt($startcol + 6);

			$this->hater_girls = $rs->getInt($startcol + 7);

			$this->nb_comments = $rs->getInt($startcol + 8);

			$this->love = $rs->getInt($startcol + 9);

			$this->sticky = $rs->getInt($startcol + 10);

			$this->is_on_homepage = $rs->getInt($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tag object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseTag:delete:pre') as $callable)
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
			$con = Propel::getConnection(TagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TagPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTag:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseTag:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(TagPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TagPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTag:save:post') as $callable)
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


												
			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TagPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TagPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = TagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTag();
				break;
			case 2:
				return $this->getStrippedTag();
				break;
			case 3:
				return $this->getCreatedBy();
				break;
			case 4:
				return $this->getLovers();
				break;
			case 5:
				return $this->getHaters();
				break;
			case 6:
				return $this->getLoverGirls();
				break;
			case 7:
				return $this->getHaterGirls();
				break;
			case 8:
				return $this->getNbComments();
				break;
			case 9:
				return $this->getLove();
				break;
			case 10:
				return $this->getSticky();
				break;
			case 11:
				return $this->getIsOnHomepage();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTag(),
			$keys[2] => $this->getStrippedTag(),
			$keys[3] => $this->getCreatedBy(),
			$keys[4] => $this->getLovers(),
			$keys[5] => $this->getHaters(),
			$keys[6] => $this->getLoverGirls(),
			$keys[7] => $this->getHaterGirls(),
			$keys[8] => $this->getNbComments(),
			$keys[9] => $this->getLove(),
			$keys[10] => $this->getSticky(),
			$keys[11] => $this->getIsOnHomepage(),
			$keys[12] => $this->getCreatedAt(),
			$keys[13] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTag($value);
				break;
			case 2:
				$this->setStrippedTag($value);
				break;
			case 3:
				$this->setCreatedBy($value);
				break;
			case 4:
				$this->setLovers($value);
				break;
			case 5:
				$this->setHaters($value);
				break;
			case 6:
				$this->setLoverGirls($value);
				break;
			case 7:
				$this->setHaterGirls($value);
				break;
			case 8:
				$this->setNbComments($value);
				break;
			case 9:
				$this->setLove($value);
				break;
			case 10:
				$this->setSticky($value);
				break;
			case 11:
				$this->setIsOnHomepage($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTag($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStrippedTag($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedBy($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLovers($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHaters($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLoverGirls($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHaterGirls($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setNbComments($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLove($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSticky($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIsOnHomepage($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TagPeer::DATABASE_NAME);

		if ($this->isColumnModified(TagPeer::ID)) $criteria->add(TagPeer::ID, $this->id);
		if ($this->isColumnModified(TagPeer::TAG)) $criteria->add(TagPeer::TAG, $this->tag);
		if ($this->isColumnModified(TagPeer::STRIPPED_TAG)) $criteria->add(TagPeer::STRIPPED_TAG, $this->stripped_tag);
		if ($this->isColumnModified(TagPeer::CREATED_BY)) $criteria->add(TagPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(TagPeer::LOVERS)) $criteria->add(TagPeer::LOVERS, $this->lovers);
		if ($this->isColumnModified(TagPeer::HATERS)) $criteria->add(TagPeer::HATERS, $this->haters);
		if ($this->isColumnModified(TagPeer::LOVER_GIRLS)) $criteria->add(TagPeer::LOVER_GIRLS, $this->lover_girls);
		if ($this->isColumnModified(TagPeer::HATER_GIRLS)) $criteria->add(TagPeer::HATER_GIRLS, $this->hater_girls);
		if ($this->isColumnModified(TagPeer::NB_COMMENTS)) $criteria->add(TagPeer::NB_COMMENTS, $this->nb_comments);
		if ($this->isColumnModified(TagPeer::LOVE)) $criteria->add(TagPeer::LOVE, $this->love);
		if ($this->isColumnModified(TagPeer::STICKY)) $criteria->add(TagPeer::STICKY, $this->sticky);
		if ($this->isColumnModified(TagPeer::IS_ON_HOMEPAGE)) $criteria->add(TagPeer::IS_ON_HOMEPAGE, $this->is_on_homepage);
		if ($this->isColumnModified(TagPeer::CREATED_AT)) $criteria->add(TagPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TagPeer::UPDATED_AT)) $criteria->add(TagPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TagPeer::DATABASE_NAME);

		$criteria->add(TagPeer::ID, $this->id);

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

		$copyObj->setTag($this->tag);

		$copyObj->setStrippedTag($this->stripped_tag);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setLovers($this->lovers);

		$copyObj->setHaters($this->haters);

		$copyObj->setLoverGirls($this->lover_girls);

		$copyObj->setHaterGirls($this->hater_girls);

		$copyObj->setNbComments($this->nb_comments);

		$copyObj->setLove($this->love);

		$copyObj->setSticky($this->sticky);

		$copyObj->setIsOnHomepage($this->is_on_homepage);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getComments() as $relObj) {
				$copyObj->addComment($relObj->copy($deepCopy));
			}

			foreach($this->getUserToTags() as $relObj) {
				$copyObj->addUserToTag($relObj->copy($deepCopy));
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
			self::$peer = new TagPeer();
		}
		return self::$peer;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setCreatedBy(NULL);
		} else {
			$this->setCreatedBy($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && ($this->created_by !== null)) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->created_by, $con);

			
		}
		return $this->aUser;
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

				$criteria->add(CommentPeer::TAGS_ID, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				$this->collComments = CommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommentPeer::TAGS_ID, $this->getId());

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

		$criteria->add(CommentPeer::TAGS_ID, $this->getId());

		return CommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComment(Comment $l)
	{
		$this->collComments[] = $l;
		$l->setTag($this);
	}


	
	public function getCommentsJoinUser($criteria = null, $con = null)
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

				$criteria->add(CommentPeer::TAGS_ID, $this->getId());

				$this->collComments = CommentPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(CommentPeer::TAGS_ID, $this->getId());

			if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
				$this->collComments = CommentPeer::doSelectJoinUser($criteria, $con);
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

				$criteria->add(UserToTagPeer::TAGS_ID, $this->getId());

				UserToTagPeer::addSelectColumns($criteria);
				$this->collUserToTags = UserToTagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserToTagPeer::TAGS_ID, $this->getId());

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

		$criteria->add(UserToTagPeer::TAGS_ID, $this->getId());

		return UserToTagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserToTag(UserToTag $l)
	{
		$this->collUserToTags[] = $l;
		$l->setTag($this);
	}


	
	public function getUserToTagsJoinUser($criteria = null, $con = null)
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

				$criteria->add(UserToTagPeer::TAGS_ID, $this->getId());

				$this->collUserToTags = UserToTagPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(UserToTagPeer::TAGS_ID, $this->getId());

			if (!isset($this->lastUserToTagCriteria) || !$this->lastUserToTagCriteria->equals($criteria)) {
				$this->collUserToTags = UserToTagPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastUserToTagCriteria = $criteria;

		return $this->collUserToTags;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTag:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTag::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 