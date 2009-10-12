<?php 
$picture = is_object($user) ? $user->getAvatar() : $user['avatar'];
$nick = is_object($user) ? $user->getNickname() : $user['nickname'];

echo link_to(image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/' . ( $picture ? $picture : '404.gif' ), array('alt' => $nick, 'title' => $nick . ' - profil sayfası')), '@user_profile?nick=' . $nick, array('title' => $nick, 'class' => 'user'));
