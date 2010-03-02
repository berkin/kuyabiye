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
  private static $max;
  
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
  
  public function getWeight()
  {
    
    // $max = $this->getMax();
      
    $total = $this->getTotal();
    
    if ( $total )
    {
      if ( $this->getLovers() > $this->getHaters() )
      {
        // $weight = round( ( $this->getLovers() / $total ) * ( $total / $max ) * 100 );
        $weight = Rating::ratingAverage($this->getLovers(), $total) * 100;
      }
      else
      {
        // $weight = round( ( $this->getHaters() / $total ) * ( $total / $max ) * 100 );      
        $weight = Rating::ratingAverage($this->getHaters(), $total) * 100;
      }
    }
    else 
    {
      $weight = 0;
    }
    
    $weight = round( $weight / 20 );
    
    return $weight;  
  }
  
  public function getTotal()
  {
    return $this->getLovers() + $this->getHaters();
  }
  
  public function getLoverBoys()
  {
    return $this->getLovers() - $this->getLoverGirls();
  }  
  public function getHaterBoys()
  {
    return $this->getHaters() - $this->getHaterGirls();
  }
  
  //singleton
  public static function getMax()
  {
    if (!isset(self::$max)) 
    {
      $now = time() - sfConfig::get('app_tag_homepage_date');
    
      $conn = Propel::getConnection();
      $query = 'SELECT MAX( ' . TagPeer::LOVERS . ' + ' . TagPeer::HATERS . ') AS max
                  FROM ' . TagPeer::TABLE_NAME;
   
      $stmt = $conn->prepareStatement($query);
      $result = $stmt->executeQuery();
      $result->next();
      
      self::$max = $result->getInt('max');
    }

    return self::$max;  
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
  
  public function __toString()
  {
    return $this->getTag();
  }
}

