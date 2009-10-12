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
  
  public static function getUserPicture($user, $id)
  {
    $c = new Criteria();
    $c->add(PicturePeer::USER_ID, $user->getId());
    $c->add(PicturePeer::ID, $id);
    
    return PicturePeer::doSelectOne($c);
  }
}
