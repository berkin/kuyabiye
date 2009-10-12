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
  
  static function updateCountOfLovers($tag)
  {
  
    $love = myTools::isTagLoved($tag);
    $sticky = myTools::isTagSticky($tag);
    
    $conn = Propel::getConnection(self::DATABASE_NAME);
    $sql = 'UPDATE ' . TagPeer::TABLE_NAME . ' 
              SET ' . TagPeer::LOVERS . ' = (
                SELECT COUNT(' . UserToTagPeer::LOVE . ') 
                  FROM ' . UserToTagPeer::TABLE_NAME  . ' 
                WHERE ' . UserToTagPeer::TAGS_ID . ' = ' . $tag->getId() . '
                  AND ' . UserToTagPeer::LOVE . ' = 1), ' .
                TagPeer::HATERS . ' = (
                SELECT COUNT(' . UserToTagPeer::LOVE . ') 
                  FROM ' . UserToTagPeer::TABLE_NAME  . ' 
                WHERE ' . UserToTagPeer::TAGS_ID . ' = ' . $tag->getId() . '
                  AND ' . UserToTagPeer::LOVE . ' = 0), ' .
                TagPeer::LOVER_GIRLS . ' = (
                SELECT COUNT(' . UserToTagPeer::USERS_ID . ') 
                  FROM ' . UserToTagPeer::TABLE_NAME . ', ' . UserPeer::TABLE_NAME . '
                WHERE ' . UserToTagPeer::TAGS_ID . ' = ' . $tag->getId() . '
                  AND ' . UserToTagPeer::LOVE . ' = 1
                  AND ' . UserPeer::GENDER . ' = 0
                  AND ' . UserToTagPeer::USERS_ID . ' = ' . UserPeer::ID . '), ' .                 
                TagPeer::HATER_GIRLS . ' = (
                SELECT COUNT(' . UserToTagPeer::USERS_ID . ') 
                  FROM ' . UserToTagPeer::TABLE_NAME . ', ' . UserPeer::TABLE_NAME . '
                WHERE ' . UserToTagPeer::TAGS_ID . ' = ' . $tag->getId() . '
                  AND ' . UserToTagPeer::LOVE . ' = 0
                  AND ' . UserPeer::GENDER . ' = 0
                  AND ' . UserToTagPeer::USERS_ID . ' = ' . UserPeer::ID . '), ' .                 
                TagPeer::LOVE . ' = ' . myTools::isTagLoved($tag) . ', ' .
                TagPeer::STICKY . ' = ' . myTools::isTagSticky($tag) . ', ' .
                TagPeer::UPDATED_AT . ' = now()' . '
              WHERE ' . TagPeer::ID . ' = ' . $tag->getId() . ';';

    $stmt = $conn->prepareStatement($sql);
    $stmt->executeQuery();
   }
   
  public static function getUserTagsPager($user, $love, $page)
  {
    $tags = new sfPropelPager('UserToTag', 2);
    $c = new Criteria();
    
    $sense = sfConfig::get('app_sense');
    if ( $sense[$love] !== null )
    {
      $c->add(self::LOVE, $sense[$love]);
    }
    $c->add(self::USERS_ID, $user->getId());
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    
    $tags->setCriteria($c);
    $tags->setPage($page);
    $tags->setPeerMethod('doSelectJoinTag');
    $tags->init();
   
    return $tags;
  }
}
