<?php

/**
 * Subclass for performing query and update operations on the 'tags' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TagPeer extends BaseTagPeer
{
  public static function getPopularTags()
  {  

    $now = time() - sfConfig::get('app_tag_homepage_date');

    $c = new Criteria();
    $c->add(TagPeer::UPDATED_AT, $now, Criteria::GREATER_THAN);
    
    $tags = TagPeer::doSelect($c);
    
    return $tags;
  }
}
