<?php
  
use_helper('Javascript');

function link_to_users_love($user, $tag)
{
  if ( $user->isAuthenticated() )
  {
    $love = UserToTagPeer::retrieveByPK($user->getSubscriberId(), $tag->getId());

    $loved     = '<span class="lover">seviyorum ' . link_to_remote('(x)', array(
        'url'       => '@user_love?id=' . $tag->getId(),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</span>';
      
    $love_link = link_to_remote('seviyor musun?', array(
        'url'       => '@user_love?loves=1&id=' . $tag->getId(),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        ));
    
    $hated     = '<span class="hater">sevmiyorum ' . link_to_remote('(x)', array(
        'url'       => '@user_love?id=' . $tag->getId(),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</span>';
      
    $hate_link = link_to_remote('sevmiyor musun?', array(
        'url'       => '@user_love?loves=0&id=' . $tag->getId(),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        ));
    if ( $love )
    {
      switch ($love->getLove())
      {
        case 0:
          // hates
          return $love_link . $hated;
          break;
        case 1:
          // loves
          return $loved . $hate_link;
          break;
        default:
          // neither
          return $love_link . $hate_link;
          break;
      }
    }
    else
    {
      return $love_link . $hate_link;
    }
  }
  else
  {
    return link_to('seviyor musun?', '@login');
  }
}
