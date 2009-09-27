<?php

/**
 * Subclass for representing a row from the 'users' table.
 *
 * 
 *
 * @package lib.model
 */ 
class User extends BaseUser
{
  public function setPassword($password)
  {
    $salt = md5(rand(100000, 999999) . $this->getNickname() . $this->getEmail());
    $this->setSalt($salt);
    $this->setSha1Password(sha1($salt . $password));
  }
  
  public function getUserToTagsJoinTag($love = true, $criteria = null, $con = null)
  {
    if (is_null($criteria))
    {
      $criteria = new Criteria();
    }
    else
    {
      // Objects are passed by reference in PHP5, so to avoid modifying the original, you must clone it
      $criteria = clone $criteria;
    }
    
    $criteria->add(UserToTagPeer::LOVE, $love);
    $criteria->SetLimit(15);
    $criteria->addDescendingOrderByColumn(UserToTagPeer::CREATED_AT);
   
    return parent::getUserToTagsJoinTag($criteria, $con);
  }
  
}
