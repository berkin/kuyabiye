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
  
  public static function getTagPage($tag_id, $comment_id, $tree_left)
  {
    $conn = Propel::getConnection();
    $query = 'SELECT count(*) AS COUNT 
                FROM (
                  SELECT count(' . self::ID . ')
                    FROM ' . self::TABLE_NAME . ' AS parent_comments, ' . 
                      self::TABLE_NAME . '
                    WHERE ' . self::TAGS_ID . ' = ?
                    AND ' . self::TREE_LEFT . ' 
                      BETWEEN parent_comments.tree_left 
                        AND parent_comments.tree_right
                    AND ' . self::TREE_LEFT . ' <= ?
                    GROUP BY ' . self::ID . '
                    ORDER BY ' . self::TREE_LEFT . ')
                AS c;';
  
  
    $stmt = $conn->prepareStatement($query);
    $stmt->setInt(1, $tag_id);
    $stmt->setInt(2, $tree_left);
    $rs = $stmt->executeQuery();
    $rs->next();
    $page = ceil(($rs->getInt('COUNT')) / 20);

    return $page;
  }
}
