<?php
  
use_helper('Javascript');

function link_to_users_love($user, $tag)
{
  $link = '';
  if ( $user->isAuthenticated() )
  {
    $love = UserToTagPeer::retrieveByPK($user->getSubscriberId(), $tag->getId());

    $loved     = '<li class="love">Seviyorum ' . link_to_remote('(x)', array(
        'url'       => '@user_love?remove=1&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</li>';
      
    $love_link = '<li class="love">' . link_to_remote('Seviyor musun?', array(
        'url'       => '@user_love?loves=1&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</li>';
    
    $hated     = '<li class="hate">Sevmiyorum ' . link_to_remote('(x)', array(
        'url'       => '@user_love?remove=1&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</li>';
      
    $hate_link = '<li class="hate">' . link_to_remote('Sevmiyor musun?', array(
        'url'       => '@user_love?loves=0&id=' . $tag->getId() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'update'    => array('success' => 'love_' . $tag->getId()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'love_' . $tag->getId()),
        )) . '</li>';
    if ( $love )
    {
      switch ($love->getLove())
      {
        case 0:
          // hates
          $link = $love_link . $hated;
          break;
        case 1:
          // loves
          $link = $loved . $hate_link;
          break;
        default:
          // neither
          $link = $love_link . $hate_link;
          break;
      }
    }
    else
    {
      $link = $love_link . $hate_link;
    }
  }
  else
  {
    $link = '<li class="love">' . link_to('Seviyor musun?', '@login') . '</li><li class="hate">' . link_to('Sevmiyor musun?', '@login') . '</li>';
  }
  
  return '<ul class="love-buttons">' . $link . '</ul>';
}

function link_to_friend_request($user, $friend)
{
  

  if ( $user->isAuthenticated() ) 
  {
    $task = sfcontext::getinstance()->getRequest()->getParameter('task');
    switch ( $task )
    {
      case 'approve':
        return '<span>Kabul edildi.</span>';
        break;
      case 'disapprove':
        return '<span>Arkadaşlık isteği silindi.</span>';
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
        return link_to_remote('Onayla', array(
              'url'       => '@friend_request?user=' . $friend->getNickname() . '&task=approve&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
              'update'    => array('success' => 'friend-request-' . $friend->getId()),
              'loading'   => "Element.show('indicator');",
              'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'friend-request-' . $friend->getId()),
              'confirm'  => "Emin misiniz?",
              ), array (
              'class'   => 'accept-icon'
              )) . 
              link_to_remote('İptal', array(
              'url'       => '@friend_request?user=' . $friend->getNickname() . '&task=disapprove&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
              'update'    => array('success' => 'friend-request-' . $friend->getId()),
              'loading'   => "Element.show('indicator');",
              'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'friend-request-' . $friend->getId()),
              'confirm'  => "Emin misiniz?",
              ), array(
              'class'   => 'cancel-icon'
              ));
      }
      else
      {
        return link_to_remote('Arkadaş Olarak Ekle', array(
              'url'       => '@friend_request?user=' . $friend->getNickname() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
              'update'    => array('success' => 'friend-request-' . $friend->getId()),
              'loading'   => "Element.show('indicator');",
              'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'friend-request-' . $friend->getId()),
              'confirm'  => "Emin misiniz?",
              ));
      }
    }
    else {
      switch ( $found->getStatus() )
      {
        case 0:
          return 'Arkadaşlık İsteği Gönderildi';
          break;
        case 1:
          return 'Listemde';
          break;
        case 2:
          return 'Bloklandı';
          break;
        default:
          return '';
          break;      
      }
    }
  }
  else
  {
    return link_to('Arkadaş Olarak Ekle?', '@login');
  } 
}