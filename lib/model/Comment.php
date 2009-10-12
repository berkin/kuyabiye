<?php

/**
 * Subclass for representing a row from the 'tags_comments' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Comment extends BaseComment
{
  public function save($conn = null)
  {
    $conn = Propel::getConnection();
    
    try
    {
      $conn->begin();
      parent::save();  
      
      $tag = $this->getTag();
      $tag->setNbComments($tag->getNbComments() + 1);
      $tag->save();
      
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
}