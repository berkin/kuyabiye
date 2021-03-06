<?php

/**
 * Subclass for representing a row from the 'messages' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Message extends BaseMessage
{
  public function setBody($v)
  {   
    require_once('markdown.php');
   
    // strip all HTML tags
    $v = htmlentities($v, ENT_QUOTES, 'UTF-8');
   
    parent::setBody(markdown($v));
  }
}
