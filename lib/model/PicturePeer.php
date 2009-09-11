<?php

/**
 * Subclass for performing query and update operations on the 'pictures' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PicturePeer extends BasePicturePeer
{
  public static function saveAvatar($user, $picture)
  {
    $user->setAvatar($picture);  
    $user->save();
  }
}
