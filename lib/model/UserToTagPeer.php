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
                  AND ' . UserToTagPeer::LOVE . ' = 0)
              WHERE ' . TagPeer::ID . ' = ' . $tag->getId() . ';';
    $stmt = $conn->prepareStatement($sql);
    $stmt->executeQuery();
   }
}
