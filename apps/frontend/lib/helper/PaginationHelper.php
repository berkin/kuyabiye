<?php
 
function pager_navigation($pager, $uri)
{
  $navigation = '';
 
  if ($pager->haveToPaginate())
  {  
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';

    // First and previous page
    $navigation .= '<ul class="pagination clearfix">';
    $navigation .= '<li>' . link_to('ilk sayfa', $uri . '1', 'class=low') . '</li>';
    $navigation .= '<li>' . link_to('geri', $uri . $pager->getPreviousPage(), 'class=love'). '</li>';

    // Pages one by one
    $links = array();
    foreach ($pager->getLinks() as $page)
    {
      $links[] = '<li>' . link_to_unless($page == $pager->getPage(), $page, $uri . $page) . '</li>';
    }
    $navigation .= join('', $links);

    // Next and last page
    $navigation .= '<li>' . link_to('ileri', $uri . $pager->getNextPage(), 'class=love') . '</li>';
    $navigation .= '<li>' . link_to('son sayfa', $uri . $pager->getLastPage(), 'class=low') . '</li>';
    $navigation .= '</ul>';
  }

  return $navigation;
}