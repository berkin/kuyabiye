<?php

class myTools
{
  public static function generate_random_key()
  {
    return md5('berkin' . rand(99, 99999) . 'carolina');
  }
  
  public static function stripText($text)
  {
    $text = strtolower($text);
 
    // strip all non word chars
    $text = preg_replace('/\W/', ' ', $text);
 
    // replace all white space sections with a dash
    $text = preg_replace('/\ +/', '-', $text);
 
    // trim dashes
    $text = preg_replace('/\-$/', '', $text);
    $text = preg_replace('/^\-/', '', $text);
 
    return $text;    
  }
  
  public static function getLimitOfLovers($counts)
  {
    // get only lovers limit
    $total = self::getTotalLovers($counts);
    
    $limits = array();
    if ( $total != 0 )
    {
      $limits['lovers'] = round( ($counts[1]/$total) * sfConfig::get('app_tag_max_lovers') );
      $limits['haters'] = sfConfig::get('app_tag_max_lovers') - $limits['lovers'];
    }
    
    return $limits;
  }
  
  public static function getTotalLovers($counts)
  {
    $total = 0;
    foreach ( $counts as $count )
    {
      $total += $count;
    }
    
    return $total;
  }
}