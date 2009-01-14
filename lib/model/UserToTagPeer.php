<?php

/**
 * Subclass for performing query and update operations on the 'users_to_tags' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserToTagPeer extends BaseUserToTagPeer
{
  public static function removeLove($user, $tag)
  {
    $removal = new UserToTag();
    $removal->setUser($user);
    $removal->setTag($tag);
    $removal->delete();
  }
  
  public static function getCountOfLovers($tagId)
  {
    $c = new Criteria();
    $c->clearSelectColumns(); // works with doSelectRS well
    $c->addSelectColumn(UserToTagPeer::LOVE);
    $c->addAsColumn('Lovers', 'COUNT(' . UserToTagPeer::USERS_ID . ')');
    $c->add(UserToTagPeer::TAGS_ID, $tagId);
    $c->addAscendingOrderByColumn(UserToTagPeer::LOVE);
    $c->addGroupByColumn(UserToTagPeer::LOVE); 
    $lovers = UserToTagPeer::doSelectRS($c);
    
    $counts = array();
    while ( $lovers->next() )
    {
      $counts[$lovers->getInt(1)] = $lovers->getInt(2);
    }
    
    return $counts;
  }
}
