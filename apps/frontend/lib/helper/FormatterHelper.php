<?php
function formatter($v)
{
  require_once('markdown.extra.php');
 
  // strip all HTML tags
  $v = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
     
  return markdown($v);
}