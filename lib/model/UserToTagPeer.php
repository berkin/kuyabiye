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
  
  public static function updateCountOfLovers($tag)
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
  
  public static function getCommonTags($subscriber, $user)
  {
    $conn = Propel::getConnection();
    $query = 'SELECT ' . TagPeer::ID . ' as tags_id, ' . TagPeer::TAG . ' as tag, ' . TagPeer::STRIPPED_TAG . ' as stripped_tag, u1.love as love
                FROM ' . UserToTagPeer::TABLE_NAME . ' as u1 , ' . UserToTagPeer::TABLE_NAME . ' as u2 , ' . TagPeer::TABLE_NAME . '
                WHERE u1.tags_id = u2.tags_id 
                  AND u1.love = u2.love 
                  AND u1.users_id = ? 
                  AND u2.users_id = ? 
                  AND ' . TagPeer::ID . ' = u1.tags_id';
    
    $stmt = $conn->prepareStatement($query);
    $stmt->setInt(1, $subscriber);
    $stmt->setInt(2, $user);
    $rs = $stmt->executeQuery();
    
    $tags = array();
    while ( $rs->next() ) 
    {
      $sense = $rs->getInt('love') ? 'love' : 'hate';
      $tags[$sense][] = array('tags_id' => $rs->getInt('tags_id'), 'tag' => $rs->getString('tag'), 'stripped_tag' => $rs->getString('stripped_tag'), 'love' => $rs->getInt('love'));
    }
    
    return $tags;
  }
   
  public static function getUserTagsPager($user, $love, $page)
  {
    $tags = new sfPropelPager('UserToTag', 40);
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
