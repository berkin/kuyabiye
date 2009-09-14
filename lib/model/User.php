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

}
