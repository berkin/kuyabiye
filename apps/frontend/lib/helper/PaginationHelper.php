<?php
 
function pager_navigation($pager, $uri)
{
  $navigation = '';
 
  if ($pager->haveToPaginate())
  {  
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';

    // First and previous page
    $navigation .= link_to('&laquo', $uri.'1');
    $navigation .= link_to('<', $uri.$pager->getPreviousPage()).'&nbsp;';

    // Pages one by one
    $links = array();
    foreach ($pager->getLinks() as $page)
    {
      $links[] = link_to_unless($page == $pager->getPage(), $page, $uri.$page);
    }
    $navigation .= join('&nbsp;&nbsp;', $links);

    // Next and last page
    $navigation .= '&nbsp;'.link_to('>', $uri.$pager->getNextPage());
    $navigation .= link_to('&raquo;', $uri.$pager->getLastPage());
  }

  return $navigation;
}