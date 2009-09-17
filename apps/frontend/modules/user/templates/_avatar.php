<?php 
$picture = is_object($user) ? $user->getAvatar() : $user['avatar'];
if ( $picture )
{
  echo image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/' . $picture);
}
else {
  echo image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/404.gif');
}
