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
  public static function getPopularTags($love = null, $sticky = null)
  {  
    $now = time();
    $days = $now - sfConfig::get('app_tag_homepage_date');
    
    $tags = array();
    // loved tags
    do
    {
      $c = new Criteria();
      if ( $love !== null )
      {
        $c->add(TagPeer::LOVE, $love);
      }
      if ( $sticky )
      {
        $c->add(TagPeer::STICKY, $sticky);      
      }
      $c->add(TagPeer::UPDATED_AT, $days, Criteria::GREATER_THAN);
      $c->setLimit(15);
        
      $tags = TagPeer::doSelect($c);
      
      $days = $days - sfConfig::get('app_tag_homepage_date');
      
      //  avoid infinite loop, 5 loops mox
      if ( $days < $now - ( sfConfig::get('app_tag_homepage_date') * 5 ) ) break;
    } 
    while ( !$tags );
    
    return $tags;
  }
  
  public static function getShowcaseTags()
  {
    $c = new Criteria();
    $c->add(TagPeer::IS_ON_HOMEPAGE, true);
    
    return TagPeer::doSelect($c);
  }
}
