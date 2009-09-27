<?php
  
use_helper('Javascript');

function link_to_users_love($user, $tag)
{
  if ( $user->isAuthenticated() )
  {
    $love = UserToTagPeer::retrieveByPK($user->getSubscriberId(), $tag->getId());

    $loved     = '<span class="lover">seviyorum ' . link_to_remote('(x)', array(
        'url'       => '@user_love?remove=1&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</span>';
      
    $love_link = link_to_remote('seviyor musun?', array(
        'url'       => '@user_love?loves=1&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        ));
    
    $hated     = '<span class="hater">sevmiyorum ' . link_to_remote('(x)', array(
        'url'       => '@user_love?remove=1&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</span>';
      
    $hate_link = link_to_remote('sevmiyor musun?', array(
        'url'       => '@user_love?loves=0&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
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
    return link_to('seviyor musun?', '@login') . ' ' . link_to('sevmiyor musun?', '@login');
  }
}

function link_to_friend_request($user, $friend)
{
  

  if ( $user->isAuthenticated() ) 
  {
    $task = sfcontext::getinstance()->getRequest()->getParameter('task');
    switch ( $task )
    {
      case 'approve':
        return 'kabul edildi';
        break;
      case 'disapprove':
        return 'red edildi';
        break;
    }

    // find friend, check if exists
    $user_to = $user->getSubscriberByNick($friend->getNickname());
    $user_from = $user->getSubscriberId();
    
    $c = new Criteria;
    $c->add(FriendPeer::USER_FROM, $user_from);
    $c->add(FriendPeer::USER_TO, $user_to->getId());
    $found = FriendPeer::doSelectOne($c);
    
    if ( empty($found) )
    {
      $c = new Criteria;
      $c->add(FriendPeer::USER_FROM, $user_to->getId());
      $c->add(FriendPeer::USER_TO, $user_from);
      $found = FriendPeer::doSelectOne($c);
       
      if ( $found )
      {
        return link_to_remote('kabul et?', array(
              'url'       => '@friend_request?user=' . $friend->getNickname() . '&task=approve&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
              'update'    => array('success' => 'friend-request-' . $friend->getId()),
              'loading'   => "Element.show('indicator');",
              'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'friend-request-' . $friend->getId()),
              'confirm'  => "Are you sure?",
              )) . 
              link_to_remote('red et?', array(
              'url'       => '@friend_request?user=' . $friend->getNickname() . '&task=disapprove&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
              'update'    => array('success' => 'friend-request-' . $friend->getId()),
              'loading'   => "Element.show('indicator');",
              'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'friend-request-' . $friend->getId()),
              'confirm'  => "Are you sure?",
              ));
      }
      else
      {
        return link_to_remote('arkadaş olarak ekle?', array(
              'url'       => '@friend_request?user=' . $friend->getNickname() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
              'update'    => array('success' => 'friend-request-' . $friend->getId()),
              'loading'   => "Element.show('indicator');",
              'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'friend-request-' . $friend->getId()),
              'confirm'  => "Are you sure?",
              ));
      }
    }
    else {
      switch ( $found->getStatus() )
      {
        case 0:
          return 'arkadaş isteği gönderildi';
          break;
        case 1:
          return 'listemde';
          break;
        case 2:
          return 'blocked';
          break;
        default:
          return '';
          break;      
      }
    }
  }
  else
  {
    return link_to('arkadaş olarak ekle?', '@login');
  } 
}