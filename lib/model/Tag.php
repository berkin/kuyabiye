<?php

/**
 * Subclass for representing a row from the 'tags' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Tag extends BaseTag
{
  public function setTag($tag)
  {
    parent::setTag($tag);
    
    $this->setStrippedTag(myTools::stripText($tag));
  }
  
  public function getTagComments($criteria = null, $con = null)
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
    
    $criteria->addDescendingOrderByColumn(TagCommentPeer::CREATED_AT);
   
    return parent::getTagComments($criteria, $con);
  }
}
