<?php

/**
 * Subclass for performing query and update operations on the 'tags_comments' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CommentPeer extends BaseCommentPeer
{
  public static function getCommentsJoinUserWithDepth($tags_id, $page)
  {
    $conn = Propel::getConnection();
    $query = 'SELECT ' . self::ID . ', ' . UserPeer::NICKNAME . ', ' . UserPeer::AVATAR . ', ' . UserToTagPeer::LOVE . ', ' . self::BODY . ', ' . self::CREATED_AT . ', COUNT(parent_comments.id) AS DEPTH
                FROM ' . self::TABLE_NAME . ' LEFT JOIN ' . UserToTagPeer::TABLE_NAME . ' ON ' . self::USERS_ID . ' = ' . UserToTagPeer::USERS_ID . ' AND ' . self::TAGS_ID . ' = ' . UserToTagPeer::TAGS_ID . ', ' . 
                  self::TABLE_NAME . ' AS parent_comments, ' . 
                  UserPeer::TABLE_NAME . '
                WHERE ' . self::TAGS_ID . ' = ' . (int)$tags_id . '
                AND ' . UserPeer::ID . ' = ' . self::USERS_ID . '
                AND ' . self::TREE_LEFT . ' 
                  BETWEEN parent_comments.tree_left 
                    AND parent_comments.tree_right
                GROUP BY ' . self::ID . '
                ORDER BY ' . self::TREE_LEFT;
  
    // $stmt = $conn->prepareStatement($query);
    // $stmt->setInt(1, $tags_id);
    // $rs = $stmt->executeQuery();
    
    // $comments = array();
    // while ( $rs->next() ) 
    // {
      // $comments[] = array('comments_id' => $rs->getInt('ID'),
                          // 'nickname'    => $rs->getString('NICKNAME'),
                          // 'avatar'      => $rs->getString('AVATAR'),
                          // 'love'        => $rs->getInt('LOVE'),
                          // 'body'        => $rs->getString('BODY'),
                          // 'depth'       => $rs->getInt('DEPTH'),
                          // 'created_at'  => $rs->getTimestamp('CREATED_AT', 'U'));
    // }

    // return $comments;
    
    $count = 'SELECT COUNT(' . self::ID . ') as count
                FROM ' . self::TABLE_NAME . ' 
                WHERE ' . self::TAGS_ID . ' = ' . (int)$tags_id;
                    
    $pager = new myCustomPager($count, $query, sfConfig::get('app_pager_tag_comment'));
    $pager->setPage($page);

    $pager->init();
    return $pager;
  }
  
  public static function updateCommentsTree($comment)
  {
    $con = Propel::getConnection();
    $sql = 'UPDATE ' . CommentPeer::TABLE_NAME . ' 
              SET ' . CommentPeer::TREE_LEFT . ' = ' . CommentPeer::TREE_LEFT . ' + 2
              WHERE ' . CommentPeer::TREE_LEFT . ' > ?;';
    
    $stmt = $con->PrepareStatement($sql);
    $stmt->setInt(1, $comment);
    $stmt->executeQuery();
    
    $sql =  'UPDATE ' . CommentPeer::TABLE_NAME . ' 
              SET ' . CommentPeer::TREE_RIGHT . ' = ' . CommentPeer::TREE_RIGHT . ' + 2 
              WHERE ' . CommentPeer::TREE_LEFT . ' > ?;';
            
    $stmt2 = $con->PrepareStatement($sql);
    $stmt2->setInt(1, $comment);
    $stmt2->executeQuery();
  }
}
