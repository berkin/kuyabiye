<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $nickname;


	
	protected $email;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $remember_key;


	
	protected $avatar;


	
	protected $activation_code;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $country;


	
	protected $city;


	
	protected $gender;


	
	protected $dob;


	
	protected $quote;


	
	protected $nb_loves = 0;


	
	protected $nb_hates = 0;


	
	protected $fb_is_on = 0;


	
	protected $fb_uuid;


	
	protected $fb_session_key;


	
	protected $fb_publish_status = 1;


	
	protected $fb_publish_love = 1;


	
	protected $fb_publish_comment = 1;


	
	protected $created_at;

	
	protected $aActivation;

	
	protected $collFriendsRelatedByUserFrom;

	
	protected $lastFriendRelatedByUserFromCriteria = null;

	
	protected $collFriendsRelatedByUserTo;

	
	protected $lastFriendRelatedByUserToCriteria = null;

	
	protected $collTags;

	
	protected $lastTagCriteria = null;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
	protected $collPictures;

	
	protected $lastPictureCriteria = null;

	
	protected $collUserToTags;

	
	protected $lastUserToTagCriteria = null;

	
	protected $collConversationsRelatedByOwner;

	
	protected $lastConversationRelatedByOwnerCriteria = null;

	
	protected $collConversationsRelatedBySender;

	
	protected $lastConversationRelatedBySenderCriteria = null;

	
	protected $collConversationsRelatedByRecipent;

	
	protected $lastConversationRelatedByRecipentCriteria = null;

	
	protected $collMessages;

	
	protected $lastMessageCriteria = null;

	
	protected $collArticles;

	
	protected $lastArticleCriteria = null;

	
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

	
	public function getAvatar()
	{

		return $this->avatar;
	}

	
	public function getActivationCode()
	{

		return $this->activation_code;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getCountry()
	{

		return $this->country;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getGender()
	{

		return $this->gender;
	}

	
	public function getDob($format = 'Y-m-d H:i:s')
	{

		if ($this->dob === null || $this->dob === '') {
			return null;
		} elseif (!is_int($this->dob)) {
						$ts = strtotime($this->dob);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [dob] as date/time value: " . var_export($this->dob, true));
			}
		} else {
			$ts = $this->dob;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getQuote()
	{

		return $this->quote;
	}

	
	public function getNbLoves()
	{

		return $this->nb_loves;
	}

	
	public function getNbHates()
	{

		return $this->nb_hates;
	}

	
	public function getFbIsOn()
	{

		return $this->fb_is_on;
	}

	
	public function getFbUuid()
	{

		return $this->fb_uuid;
	}

	
	public function getFbSessionKey()
	{

		return $this->fb_session_key;
	}

	
	public function getFbPublishStatus()
	{

		return $this->fb_publish_status;
	}

	
	public function getFbPublishLove()
	{

		return $this->fb_publish_love;
	}

	
	public function getFbPublishComment()
	{

		return $this->fb_publish_comment;
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
	
	public function setAvatar($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->avatar !== $v) {
			$this->avatar = $v;
			$this->modifiedColumns[] = UserPeer::AVATAR;
		}

	} 
	
	public function setActivationCode($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->activation_code !== $v) {
			$this->activation_code = $v;
			$this->modifiedColumns[] = UserPeer::ACTIVATION_CODE;
		}

		if ($this->aActivation !== null && $this->aActivation->getId() !== $v) {
			$this->aActivation = null;
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
	
	public function setCountry($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = UserPeer::COUNTRY;
		}

	} 
	
	public function setCity($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = UserPeer::CITY;
		}

	} 
	
	public function setGender($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = UserPeer::GENDER;
		}

	} 
	
	public function setDob($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [dob] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->dob !== $ts) {
			$this->dob = $ts;
			$this->modifiedColumns[] = UserPeer::DOB;
		}

	} 
	
	public function setQuote($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->quote !== $v) {
			$this->quote = $v;
			$this->modifiedColumns[] = UserPeer::QUOTE;
		}

	} 
	
	public function setNbLoves($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->nb_loves !== $v || $v === 0) {
			$this->nb_loves = $v;
			$this->modifiedColumns[] = UserPeer::NB_LOVES;
		}

	} 
	
	public function setNbHates($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->nb_hates !== $v || $v === 0) {
			$this->nb_hates = $v;
			$this->modifiedColumns[] = UserPeer::NB_HATES;
		}

	} 
	
	public function setFbIsOn($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fb_is_on !== $v || $v === 0) {
			$this->fb_is_on = $v;
			$this->modifiedColumns[] = UserPeer::FB_IS_ON;
		}

	} 
	
	public function setFbUuid($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fb_uuid !== $v) {
			$this->fb_uuid = $v;
			$this->modifiedColumns[] = UserPeer::FB_UUID;
		}

	} 
	
	public function setFbSessionKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fb_session_key !== $v) {
			$this->fb_session_key = $v;
			$this->modifiedColumns[] = UserPeer::FB_SESSION_KEY;
		}

	} 
	
	public function setFbPublishStatus($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fb_publish_status !== $v || $v === 1) {
			$this->fb_publish_status = $v;
			$this->modifiedColumns[] = UserPeer::FB_PUBLISH_STATUS;
		}

	} 
	
	public function setFbPublishLove($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fb_publish_love !== $v || $v === 1) {
			$this->fb_publish_love = $v;
			$this->modifiedColumns[] = UserPeer::FB_PUBLISH_LOVE;
		}

	} 
	
	public function setFbPublishComment($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fb_publish_comment !== $v || $v === 1) {
			$this->fb_publish_comment = $v;
			$this->modifiedColumns[] = UserPeer::FB_PUBLISH_COMMENT;
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

			$this->avatar = $rs->getString($startcol + 6);

			$this->activation_code = $rs->getInt($startcol + 7);

			$this->first_name = $rs->getString($startcol + 8);

			$this->last_name = $rs->getString($startcol + 9);

			$this->country = $rs->getString($startcol + 10);

			$this->city = $rs->getString($startcol + 11);

			$this->gender = $rs->getInt($startcol + 12);

			$this->dob = $rs->getTimestamp($startcol + 13, null);

			$this->quote = $rs->getString($startcol + 14);

			$this->nb_loves = $rs->getInt($startcol + 15);

			$this->nb_hates = $rs->getInt($startcol + 16);

			$this->fb_is_on = $rs->getInt($startcol + 17);

			$this->fb_uuid = $rs->getString($startcol + 18);

			$this->fb_session_key = $rs->getString($startcol + 19);

			$this->fb_publish_status = $rs->getInt($startcol + 20);

			$this->fb_publish_love = $rs->getInt($startcol + 21);

			$this->fb_publish_comment = $rs->getInt($startcol + 22);

			$this->created_at = $rs->getTimestamp($startcol + 23, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 24; 
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


												
			if ($this->aActivation !== null) {
				if ($this->aActivation->isModified()) {
					$affectedRows += $this->aActivation->save($con);
				}
				$this->setActivation($this->aActivation);
			}


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

			if ($this->collPictures !== null) {
				foreach($this->collPictures as $referrerFK) {
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

			if ($this->collConversationsRelatedByOwner !== null) {
				foreach($this->collConversationsRelatedByOwner as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConversationsRelatedBySender !== null) {
				foreach($this->collConversationsRelatedBySender as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConversationsRelatedByRecipent !== null) {
				foreach($this->collConversationsRelatedByRecipent as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMessages !== null) {
				foreach($this->collMessages as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collArticles !== null) {
				foreach($this->collArticles as $referrerFK) {
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


												
			if ($this->aActivation !== null) {
				if (!$this->aActivation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActivation->getValidationFailures());
				}
			}


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

				if ($this->collPictures !== null) {
					foreach($this->collPictures as $referrerFK) {
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

				if ($this->collConversationsRelatedByOwner !== null) {
					foreach($this->collConversationsRelatedByOwner as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConversationsRelatedBySender !== null) {
					foreach($this->collConversationsRelatedBySender as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConversationsRelatedByRecipent !== null) {
					foreach($this->collConversationsRelatedByRecipent as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMessages !== null) {
					foreach($this->collMessages as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collArticles !== null) {
					foreach($this->collArticles as $referrerFK) {
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
				return $this->getAvatar();
				break;
			case 7:
				return $this->getActivationCode();
				break;
			case 8:
				return $this->getFirstName();
				break;
			case 9:
				return $this->getLastName();
				break;
			case 10:
				return $this->getCountry();
				break;
			case 11:
				return $this->getCity();
				break;
			case 12:
				return $this->getGender();
				break;
			case 13:
				return $this->getDob();
				break;
			case 14:
				return $this->getQuote();
				break;
			case 15:
				return $this->getNbLoves();
				break;
			case 16:
				return $this->getNbHates();
				break;
			case 17:
				return $this->getFbIsOn();
				break;
			case 18:
				return $this->getFbUuid();
				break;
			case 19:
				return $this->getFbSessionKey();
				break;
			case 20:
				return $this->getFbPublishStatus();
				break;
			case 21:
				return $this->getFbPublishLove();
				break;
			case 22:
				return $this->getFbPublishComment();
				break;
			case 23:
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
			$keys[6] => $this->getAvatar(),
			$keys[7] => $this->getActivationCode(),
			$keys[8] => $this->getFirstName(),
			$keys[9] => $this->getLastName(),
			$keys[10] => $this->getCountry(),
			$keys[11] => $this->getCity(),
			$keys[12] => $this->getGender(),
			$keys[13] => $this->getDob(),
			$keys[14] => $this->getQuote(),
			$keys[15] => $this->getNbLoves(),
			$keys[16] => $this->getNbHates(),
			$keys[17] => $this->getFbIsOn(),
			$keys[18] => $this->getFbUuid(),
			$keys[19] => $this->getFbSessionKey(),
			$keys[20] => $this->getFbPublishStatus(),
			$keys[21] => $this->getFbPublishLove(),
			$keys[22] => $this->getFbPublishComment(),
			$keys[23] => $this->getCreatedAt(),
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
				$this->setAvatar($value);
				break;
			case 7:
				$this->setActivationCode($value);
				break;
			case 8:
				$this->setFirstName($value);
				break;
			case 9:
				$this->setLastName($value);
				break;
			case 10:
				$this->setCountry($value);
				break;
			case 11:
				$this->setCity($value);
				break;
			case 12:
				$this->setGender($value);
				break;
			case 13:
				$this->setDob($value);
				break;
			case 14:
				$this->setQuote($value);
				break;
			case 15:
				$this->setNbLoves($value);
				break;
			case 16:
				$this->setNbHates($value);
				break;
			case 17:
				$this->setFbIsOn($value);
				break;
			case 18:
				$this->setFbUuid($value);
				break;
			case 19:
				$this->setFbSessionKey($value);
				break;
			case 20:
				$this->setFbPublishStatus($value);
				break;
			case 21:
				$this->setFbPublishLove($value);
				break;
			case 22:
				$this->setFbPublishComment($value);
				break;
			case 23:
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
		if (array_key_exists($keys[6], $arr)) $this->setAvatar($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setActivationCode($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFirstName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLastName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCountry($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCity($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setGender($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDob($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setQuote($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setNbLoves($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setNbHates($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFbIsOn($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setFbUuid($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setFbSessionKey($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setFbPublishStatus($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setFbPublishLove($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setFbPublishComment($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCreatedAt($arr[$keys[23]]);
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
		if ($this->isColumnModified(UserPeer::AVATAR)) $criteria->add(UserPeer::AVATAR, $this->avatar);
		if ($this->isColumnModified(UserPeer::ACTIVATION_CODE)) $criteria->add(UserPeer::ACTIVATION_CODE, $this->activation_code);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::COUNTRY)) $criteria->add(UserPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(UserPeer::CITY)) $criteria->add(UserPeer::CITY, $this->city);
		if ($this->isColumnModified(UserPeer::GENDER)) $criteria->add(UserPeer::GENDER, $this->gender);
		if ($this->isColumnModified(UserPeer::DOB)) $criteria->add(UserPeer::DOB, $this->dob);
		if ($this->isColumnModified(UserPeer::QUOTE)) $criteria->add(UserPeer::QUOTE, $this->quote);
		if ($this->isColumnModified(UserPeer::NB_LOVES)) $criteria->add(UserPeer::NB_LOVES, $this->nb_loves);
		if ($this->isColumnModified(UserPeer::NB_HATES)) $criteria->add(UserPeer::NB_HATES, $this->nb_hates);
		if ($this->isColumnModified(UserPeer::FB_IS_ON)) $criteria->add(UserPeer::FB_IS_ON, $this->fb_is_on);
		if ($this->isColumnModified(UserPeer::FB_UUID)) $criteria->add(UserPeer::FB_UUID, $this->fb_uuid);
		if ($this->isColumnModified(UserPeer::FB_SESSION_KEY)) $criteria->add(UserPeer::FB_SESSION_KEY, $this->fb_session_key);
		if ($this->isColumnModified(UserPeer::FB_PUBLISH_STATUS)) $criteria->add(UserPeer::FB_PUBLISH_STATUS, $this->fb_publish_status);
		if ($this->isColumnModified(UserPeer::FB_PUBLISH_LOVE)) $criteria->add(UserPeer::FB_PUBLISH_LOVE, $this->fb_publish_love);
		if ($this->isColumnModified(UserPeer::FB_PUBLISH_COMMENT)) $criteria->add(UserPeer::FB_PUBLISH_COMMENT, $this->fb_publish_comment);
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

		$copyObj->setAvatar($this->avatar);

		$copyObj->setActivationCode($this->activation_code);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setCountry($this->country);

		$copyObj->setCity($this->city);

		$copyObj->setGender($this->gender);

		$copyObj->setDob($this->dob);

		$copyObj->setQuote($this->quote);

		$copyObj->setNbLoves($this->nb_loves);

		$copyObj->setNbHates($this->nb_hates);

		$copyObj->setFbIsOn($this->fb_is_on);

		$copyObj->setFbUuid($this->fb_uuid);

		$copyObj->setFbSessionKey($this->fb_session_key);

		$copyObj->setFbPublishStatus($this->fb_publish_status);

		$copyObj->setFbPublishLove($this->fb_publish_love);

		$copyObj->setFbPublishComment($this->fb_publish_comment);

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

			foreach($this->getPictures() as $relObj) {
				$copyObj->addPicture($relObj->copy($deepCopy));
			}

			foreach($this->getUserToTags() as $relObj) {
				$copyObj->addUserToTag($relObj->copy($deepCopy));
			}

			foreach($this->getConversationsRelatedByOwner() as $relObj) {
				$copyObj->addConversationRelatedByOwner($relObj->copy($deepCopy));
			}

			foreach($this->getConversationsRelatedBySender() as $relObj) {
				$copyObj->addConversationRelatedBySender($relObj->copy($deepCopy));
			}

			foreach($this->getConversationsRelatedByRecipent() as $relObj) {
				$copyObj->addConversationRelatedByRecipent($relObj->copy($deepCopy));
			}

			foreach($this->getMessages() as $relObj) {
				$copyObj->addMessage($relObj->copy($deepCopy));
			}

			foreach($this->getArticles() as $relObj) {
				$copyObj->addArticle($relObj->copy($deepCopy));
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

	
	public function setActivation($v)
	{


		if ($v === null) {
			$this->setActivationCode(NULL);
		} else {
			$this->setActivationCode($v->getId());
		}


		$this->aActivation = $v;
	}


	
	public function getActivation($con = null)
	{
		if ($this->aActivation === null && ($this->activation_code !== null)) {
						include_once 'lib/model/om/BaseActivationPeer.php';

			$this->aActivation = ActivationPeer::retrieveByPK($this->activation_code, $con);

			
		}
		return $this->aActivation;
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

	
	public function initPictures()
	{
		if ($this->collPictures === null) {
			$this->collPictures = array();
		}
	}

	
	public function getPictures($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePicturePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPictures === null) {
			if ($this->isNew()) {
			   $this->collPictures = array();
			} else {

				$criteria->add(PicturePeer::USER_ID, $this->getId());

				PicturePeer::addSelectColumns($criteria);
				$this->collPictures = PicturePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PicturePeer::USER_ID, $this->getId());

				PicturePeer::addSelectColumns($criteria);
				if (!isset($this->lastPictureCriteria) || !$this->lastPictureCriteria->equals($criteria)) {
					$this->collPictures = PicturePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPictureCriteria = $criteria;
		return $this->collPictures;
	}

	
	public function countPictures($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePicturePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PicturePeer::USER_ID, $this->getId());

		return PicturePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPicture(Picture $l)
	{
		$this->collPictures[] = $l;
		$l->setUser($this);
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

	
	public function initConversationsRelatedByOwner()
	{
		if ($this->collConversationsRelatedByOwner === null) {
			$this->collConversationsRelatedByOwner = array();
		}
	}

	
	public function getConversationsRelatedByOwner($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConversationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConversationsRelatedByOwner === null) {
			if ($this->isNew()) {
			   $this->collConversationsRelatedByOwner = array();
			} else {

				$criteria->add(ConversationPeer::OWNER, $this->getId());

				ConversationPeer::addSelectColumns($criteria);
				$this->collConversationsRelatedByOwner = ConversationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConversationPeer::OWNER, $this->getId());

				ConversationPeer::addSelectColumns($criteria);
				if (!isset($this->lastConversationRelatedByOwnerCriteria) || !$this->lastConversationRelatedByOwnerCriteria->equals($criteria)) {
					$this->collConversationsRelatedByOwner = ConversationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConversationRelatedByOwnerCriteria = $criteria;
		return $this->collConversationsRelatedByOwner;
	}

	
	public function countConversationsRelatedByOwner($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConversationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConversationPeer::OWNER, $this->getId());

		return ConversationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConversationRelatedByOwner(Conversation $l)
	{
		$this->collConversationsRelatedByOwner[] = $l;
		$l->setUserRelatedByOwner($this);
	}

	
	public function initConversationsRelatedBySender()
	{
		if ($this->collConversationsRelatedBySender === null) {
			$this->collConversationsRelatedBySender = array();
		}
	}

	
	public function getConversationsRelatedBySender($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConversationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConversationsRelatedBySender === null) {
			if ($this->isNew()) {
			   $this->collConversationsRelatedBySender = array();
			} else {

				$criteria->add(ConversationPeer::SENDER, $this->getId());

				ConversationPeer::addSelectColumns($criteria);
				$this->collConversationsRelatedBySender = ConversationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConversationPeer::SENDER, $this->getId());

				ConversationPeer::addSelectColumns($criteria);
				if (!isset($this->lastConversationRelatedBySenderCriteria) || !$this->lastConversationRelatedBySenderCriteria->equals($criteria)) {
					$this->collConversationsRelatedBySender = ConversationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConversationRelatedBySenderCriteria = $criteria;
		return $this->collConversationsRelatedBySender;
	}

	
	public function countConversationsRelatedBySender($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConversationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConversationPeer::SENDER, $this->getId());

		return ConversationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConversationRelatedBySender(Conversation $l)
	{
		$this->collConversationsRelatedBySender[] = $l;
		$l->setUserRelatedBySender($this);
	}

	
	public function initConversationsRelatedByRecipent()
	{
		if ($this->collConversationsRelatedByRecipent === null) {
			$this->collConversationsRelatedByRecipent = array();
		}
	}

	
	public function getConversationsRelatedByRecipent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConversationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConversationsRelatedByRecipent === null) {
			if ($this->isNew()) {
			   $this->collConversationsRelatedByRecipent = array();
			} else {

				$criteria->add(ConversationPeer::RECIPENT, $this->getId());

				ConversationPeer::addSelectColumns($criteria);
				$this->collConversationsRelatedByRecipent = ConversationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConversationPeer::RECIPENT, $this->getId());

				ConversationPeer::addSelectColumns($criteria);
				if (!isset($this->lastConversationRelatedByRecipentCriteria) || !$this->lastConversationRelatedByRecipentCriteria->equals($criteria)) {
					$this->collConversationsRelatedByRecipent = ConversationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConversationRelatedByRecipentCriteria = $criteria;
		return $this->collConversationsRelatedByRecipent;
	}

	
	public function countConversationsRelatedByRecipent($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConversationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConversationPeer::RECIPENT, $this->getId());

		return ConversationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConversationRelatedByRecipent(Conversation $l)
	{
		$this->collConversationsRelatedByRecipent[] = $l;
		$l->setUserRelatedByRecipent($this);
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

				$criteria->add(MessagePeer::WRITER, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				$this->collMessages = MessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MessagePeer::WRITER, $this->getId());

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

		$criteria->add(MessagePeer::WRITER, $this->getId());

		return MessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMessage(Message $l)
	{
		$this->collMessages[] = $l;
		$l->setUser($this);
	}


	
	public function getMessagesJoinConversation($criteria = null, $con = null)
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

				$criteria->add(MessagePeer::WRITER, $this->getId());

				$this->collMessages = MessagePeer::doSelectJoinConversation($criteria, $con);
			}
		} else {
									
			$criteria->add(MessagePeer::WRITER, $this->getId());

			if (!isset($this->lastMessageCriteria) || !$this->lastMessageCriteria->equals($criteria)) {
				$this->collMessages = MessagePeer::doSelectJoinConversation($criteria, $con);
			}
		}
		$this->lastMessageCriteria = $criteria;

		return $this->collMessages;
	}

	
	public function initArticles()
	{
		if ($this->collArticles === null) {
			$this->collArticles = array();
		}
	}

	
	public function getArticles($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseArticlePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArticles === null) {
			if ($this->isNew()) {
			   $this->collArticles = array();
			} else {

				$criteria->add(ArticlePeer::AUTHOR, $this->getId());

				ArticlePeer::addSelectColumns($criteria);
				$this->collArticles = ArticlePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ArticlePeer::AUTHOR, $this->getId());

				ArticlePeer::addSelectColumns($criteria);
				if (!isset($this->lastArticleCriteria) || !$this->lastArticleCriteria->equals($criteria)) {
					$this->collArticles = ArticlePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArticleCriteria = $criteria;
		return $this->collArticles;
	}

	
	public function countArticles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseArticlePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ArticlePeer::AUTHOR, $this->getId());

		return ArticlePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addArticle(Article $l)
	{
		$this->collArticles[] = $l;
		$l->setUser($this);
	}


	
	public function getArticlesJoinCategory($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseArticlePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArticles === null) {
			if ($this->isNew()) {
				$this->collArticles = array();
			} else {

				$criteria->add(ArticlePeer::AUTHOR, $this->getId());

				$this->collArticles = ArticlePeer::doSelectJoinCategory($criteria, $con);
			}
		} else {
									
			$criteria->add(ArticlePeer::AUTHOR, $this->getId());

			if (!isset($this->lastArticleCriteria) || !$this->lastArticleCriteria->equals($criteria)) {
				$this->collArticles = ArticlePeer::doSelectJoinCategory($criteria, $con);
			}
		}
		$this->lastArticleCriteria = $criteria;

		return $this->collArticles;
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