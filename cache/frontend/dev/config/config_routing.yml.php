<?php
// auto-generated by sfRoutingConfigHandler
// date: 2009/09/06 19:12:45
$routes = sfRouting::getInstance();
$routes->setRoutes(
array (
  'homepage' => 
  array (
    0 => '/',
    1 => '/^[\\/]*$/',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'tag',
      'action' => 'index',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'register' => 
  array (
    0 => '/register/*',
    1 => '#^/register(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'register',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'login' => 
  array (
    0 => '/login/*',
    1 => '#^/login(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'login',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'logout' => 
  array (
    0 => '/logout/*',
    1 => '#^/logout(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'logout',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'tag_add' => 
  array (
    0 => '/tag/add/*',
    1 => '#^/tag/add(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'tag',
      'action' => 'add',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'tag_search' => 
  array (
    0 => '/tag/search/*',
    1 => '#^/tag/search(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'tag',
      'action' => 'search',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'tag' => 
  array (
    0 => '/tag/:stripped_tag/*',
    1 => '#^/tag(?:\\/([^\\/]+))?(?:\\/(.*))?$#',
    2 => 
    array (
      0 => 'stripped_tag',
    ),
    3 => 
    array (
      'stripped_tag' => 1,
    ),
    4 => 
    array (
      'module' => 'tag',
      'action' => 'show',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'add_comment' => 
  array (
    0 => '/comment/add/*',
    1 => '#^/comment/add(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'comment',
      'action' => 'add',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'user_pictures' => 
  array (
    0 => '/user/pictures/*',
    1 => '#^/user/pictures(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'picture',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'user_profile' => 
  array (
    0 => '/user/show/*',
    1 => '#^/user/show(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'show',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'user_edit_profile' => 
  array (
    0 => '/user/profile/*',
    1 => '#^/user/profile(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'profile',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'user_love' => 
  array (
    0 => '/user/love/*',
    1 => '#^/user/love(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'love',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'user_notr' => 
  array (
    0 => '/user/notr/*',
    1 => '#^/user/notr(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'user',
      'action' => 'notr',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'friends' => 
  array (
    0 => '/friends/*',
    1 => '#^/friends(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'friend',
      'action' => 'list',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'friend_request' => 
  array (
    0 => '/friend/add/*',
    1 => '#^/friend/add(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'friend',
      'action' => 'add',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'friend_request_list' => 
  array (
    0 => '/friend/requests/*',
    1 => '#^/friend/requests(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'friend',
      'action' => 'request',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'conversations' => 
  array (
    0 => '/mailbox/:folder/*',
    1 => '#^/mailbox(?:\\/([^\\/]+))?(?:\\/(.*))?$#',
    2 => 
    array (
      0 => 'folder',
    ),
    3 => 
    array (
      'folder' => 1,
    ),
    4 => 
    array (
      'module' => 'conversation',
      'action' => 'index',
      'folder' => 'inbox',
      'display' => true,
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'conversation_read' => 
  array (
    0 => '/mail/read/*',
    1 => '#^/mail/read(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'conversation',
      'action' => 'read',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'conversation_compose' => 
  array (
    0 => '/mail/compose/*',
    1 => '#^/mail/compose(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'conversation',
      'action' => 'compose',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'conversation_reply' => 
  array (
    0 => '/mail/reply/*',
    1 => '#^/mail/reply(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'conversation',
      'action' => 'reply',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'conversation_remove' => 
  array (
    0 => '/mail/remove/*',
    1 => '#^/mail/remove(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'conversation',
      'action' => 'remove',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'messages' => 
  array (
    0 => '/messages/*',
    1 => '#^/messages(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'message',
      'action' => 'index',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'message_read' => 
  array (
    0 => '/message/read/*',
    1 => '#^/message/read(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'message',
      'action' => 'read',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'message_add' => 
  array (
    0 => '/message/new/*',
    1 => '#^/message/new(?:\\/(.*))?$#',
    2 => 
    array (
    ),
    3 => 
    array (
    ),
    4 => 
    array (
      'module' => 'message',
      'action' => 'add',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'default_symfony' => 
  array (
    0 => '/symfony/:action/*',
    1 => '#^/symfony(?:\\/([^\\/]+))?(?:\\/(.*))?$#',
    2 => 
    array (
      0 => 'action',
    ),
    3 => 
    array (
      'action' => 1,
    ),
    4 => 
    array (
      'module' => 'default',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'default_index' => 
  array (
    0 => '/:module',
    1 => '#^(?:\\/([^\\/]+))?$#',
    2 => 
    array (
      0 => 'module',
    ),
    3 => 
    array (
      'module' => 1,
    ),
    4 => 
    array (
      'action' => 'index',
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
  'default' => 
  array (
    0 => '/:module/:action/*',
    1 => '#^(?:\\/([^\\/]+))?(?:\\/([^\\/]+))?(?:\\/(.*))?$#',
    2 => 
    array (
      0 => 'module',
      1 => 'action',
    ),
    3 => 
    array (
      'module' => 1,
      'action' => 1,
    ),
    4 => 
    array (
    ),
    5 => 
    array (
    ),
    6 => '',
  ),
)
);
