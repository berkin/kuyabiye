<?php

/**
 * Subclass for representing a row from the 'users_to_tags' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserToTag extends BaseUserToTag
{
  public function save($conn = null)
  {
    $conn = Propel::getConnection();
    
    try
    {
      $conn->begin();
      parent::save();  
      
      UserToTagPeer::updateCountOfLovers($this->getTag());
      UserToTagPeer::updateCountOfUserLoves($this->getUser());
      
      $conn->commit();
      return true;
    }
    catch ( Exception $e )
    {
      $conn->rollback();
      throw $e;
      return false;
    }
  }
  
  public function delete($conn = null)
  {
    $conn = Propel::getConnection();
    
    try
    {
      $conn->begin();
      parent::delete();
      
      UserToTagPeer::updateCountOfLovers($this->getTag());
      UserToTagPeer::updateCountOfUserLoves($this->getUser());
     
      $conn->commit();
      return true;
    }
    catch (Exception $e)
    {
      $conn->rollback();
      throw $e;
      return false;
    }
  }
  
}
