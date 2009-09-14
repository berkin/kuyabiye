<?php 
if ( $user->getAvatar() )
{
  echo image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/' . $user->getAvatar());
}
else {
  echo image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/404.gif');
}
