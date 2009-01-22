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
    
    $slug = myTools::slugify($tag);
    
    $search = $slug;
    $i = 1;
    do {
      $i++;
      
      $c = new Criteria();
      $c->add(TagPeer::STRIPPED_TAG, $search);
      $found = TagPeer::doSelectOne($c);
      if ( !$found )
      {
        break;
      }
      else {
        $search = $slug . '-' . $i;
      }
    } while ( $i > 1);
    
    $this->setStrippedTag($search);
  }
  
  public function getCommentsJoinUser($criteria = null, $con = null)
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
    
    $criteria->addAlias("parent_comment", CommentPeer::TABLE_NAME);
    
    // this don't allow to calculate depth also
    $criteria->add("parent_comment.id", CommentPeer::ID . " = parent_comment.id", Criteria::CUSTOM);
    $criteria->add(CommentPeer::TREE_LEFT, CommentPeer::TREE_LEFT . " between parent_comment.tree_left and parent_comment.tree_right", Criteria::CUSTOM);
    // depth criteria with group by
    // $criteria->addSelectColumn("COUNT(parent_comment.tree_left) as depth");
    // $criteria->addGroupByColumn('parent_comment.tree_left');
    $criteria->addAscendingOrderByColumn(CommentPeer::TREE_LEFT);
   
    return parent::getCommentsJoinUser($criteria, $con);
  }
}

