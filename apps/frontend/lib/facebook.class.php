<?php
class facebookPublishStream
{
  static public function publishStatusStream($user, $status)
  {
    $appapikey = sfConfig::get('app_facebook_api_key');
    $appsecret = sfConfig::get('app_facebook_api_secret');
    $facebook = new Facebook($appapikey, $appsecret);
    $facebook->set_user($user->getFbUuid(), $user->getFbSessionKey());
    
    $facebook->api_client->stream_publish($status);  
  }
  static public function publishLoveStream($user, $tag, $love)
  {
    $appapikey = sfConfig::get('app_facebook_api_key');
    $appsecret = sfConfig::get('app_facebook_api_secret');
    $facebook = new Facebook($appapikey, $appsecret);
    $facebook->set_user($user->getFbUuid(), $user->getFbSessionKey());
    
    $url = sfContext::getInstance()->getController()->genUrl('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=', true);
    $message = '"' . $tag . '" etiketini ' .  ( $love ? 'sevdiklerine' : ' sevmediklerine' ) . ' ekledi.';

    $attachment = array(
          'name' => $tag->getTag(),
          'href' => $url,
          'caption' => 'www.kuyabiye.com',
          'description' => $user->getNickname() . ' "' . $tag . '" etiketini ' . ($love ? 'sevdiklerine' : 'sevmediklerine') . ' ekledi. Sen de sevdiğin veya sevmediğin herşeyi profilinde paylaş!',
          'properties' => array('Sevenler' => array(
                                'text' => (int)$tag->getLovers() . ' kişi seviyor, ' . $tag->getHaters() . ' kişi sevmiyor',
                                'href' => $url)
                                )
      );
    $action_links = array(
                          array('text' => 'Sen de Seviyor musun?',
                                'href' => $url));
    $attachment = json_encode($attachment);
    $action_links = json_encode($action_links);
    $facebook->api_client->stream_publish($message, $attachment, $action_links);  
  }
  
  static public function publishCommentStream($user, $tag, $comment)
  {
    $appapikey = sfConfig::get('app_facebook_api_key');
    $appsecret = sfConfig::get('app_facebook_api_secret');
    $facebook = new Facebook($appapikey, $appsecret);
    $facebook->set_user($user->getFbUuid(), $user->getFbSessionKey());
    
    $page = CommentPeer::getTagPage($tag->getId(), $comment->getId(), $comment->getTreeLeft());

    $url = sfContext::getInstance()->getController()->genUrl('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=' . ($page == 1 ? '' : $page ) . '#yorum' . ($comment_id == 0 ? '' : '-' . $comment->getId()), true);
    $message = '"' . $tag . '" etiketine yorum ekledi.';

    $attachment = array(
          'name' => $tag->getTag(),
          'href' => $url,
          'caption' => 'www.kuyabiye.com',
          'description' => strip_tags($comment->getBody()),
          'properties' => array('Yorum' => array(
                                'text' =>'Okumak için tıklayın',
                                'href' => $url)
                                )
      );
    $action_links = array(
                          array('text' => 'Sen de Seviyor musun?',
                                'href' => $url));
    $attachment = json_encode($attachment);
    $action_links = json_encode($action_links);
    $facebook->api_client->stream_publish($message, $attachment, $action_links);  
  }
}

