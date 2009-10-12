<?php

/**
 * Subclass for performing query and update operations on the 'users' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserPeer extends BaseUserPeer
{
  public static function getLovers($counts, $tags_id)
  {
    $limits = myTools::getLimitOfLovers($counts, sfConfig::get('app_tag_max_lovers'));

    $conn = Propel::getConnection();
    $query = '(SELECT %1$s AS nickname, %8$s AS avatar, %7$s AS love FROM %2$s
                INNER JOIN %3$s
                  ON %4$s = %5$s
                WHERE %6$s = ?
                  AND %7$s = ?
                  LIMIT ?)
                UNION (
                SELECT %1$s AS nickname, %8$s AS avatar, %7$s AS love FROM %2$s
                  INNER JOIN %3$s
                    ON %4$s = %5$s
                  WHERE %6$s = ?
                    AND %7$s = ?
                    LIMIT ?)';
                
    $query = sprintf($query,
      self::NICKNAME,
      self::TABLE_NAME,
      UserToTagPeer::TABLE_NAME,
      UserToTagPeer::USERS_ID,
      self::ID,
      UserToTagPeer::TAGS_ID,
      UserToTagPeer::LOVE,
      self::AVATAR);
    
    $stmt = $conn->prepareStatement($query);
    $stmt->setInt(1, $tags_id);
    $stmt->setInt(2, 1);
    $stmt->setInt(3, $limits['lovers']);
    $stmt->setInt(4, $tags_id);
    $stmt->setInt(5, 0);
    $stmt->setInt(6, $limits['haters']);
    $rs = $stmt->executeQuery();
    
    $users = array();
    $loveString = sfConfig::get('app_loves');
    while ( $rs->next() ) 
    {
      $sense = $rs->getInt('love') == 0 ? 'haters' : 'lovers';
      $users[$sense][] = array('nickname' => $rs->getString('nickname'), 'avatar' => $rs->getString('avatar'), 'love' => $loveString[$rs->getInt('love')]);
    }
    return $users;
  }
  
  public static function checkUser($nickname)
  {
    $c = new Criteria;
    $c->add(UserPeer::NICKNAME, $nickname);
    $found = ( UserPeer::doCount($c) ) ? true : false;
    
    return $found;
  }
  
}
