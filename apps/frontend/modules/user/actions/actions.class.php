<?php

/**
 * user actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class userActions extends sfActions
{

  public function executeShow()
  {
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);
    
    $this->tags = $this->subscriber->getUserToTagsJoinTag();
    $this->comments = $this->subscriber->getCommentsJoinTag();
    
    $this->owner = ( $this->subscriber->getNickname() == $this->getUser()->getNickname() ) ? true : false;
  }

  public function executeRegister()
  {
    // save user
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {
      $user = new User();
      
      $user->setNickname($this->getRequestParameter('nickname'));
      $user->setEmail($this->getRequestParameter('email'));
      $user->setPassword($this->getRequestParameter('password'));
      $user->setFirstname($this->getRequestParameter('firstname'));
      $user->setLastname($this->getRequestParameter('lastname'));
      
      $user->save();
      
      $this->getUser()->signIn($user);
      $this->redirect('@user_profile');
    }
  }
  
  public function executeProfile()
  {
    $this->user = $this->getUser()->getSubscriber();
    $this->cities = sfConfig::get('app_city');

    // save user
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {
      $this->user->setEmail($this->getRequestParameter('email'));
      if ( $this->getRequestParameter('password') )
      {
        $this->user->setPassword($this->getRequestParameter('password'));
      }
      $this->user->setFirstname($this->getRequestParameter('firstname'));
      $this->user->setLastname($this->getRequestParameter('lastname'));
      $this->user->setCountry($this->getRequestParameter('country'));
      $this->user->setCity($this->getRequestParameter('city'));
      $this->user->setGender($this->getRequestParameter('gender'));
      $this->user->setDob(implode('-', $this->getRequestParameter('dob')));
      
      $this->user->save();
    }    
  }
    
  public function executeLogin()
  {
    if ( $this->getRequest()->getMethod() != sfRequest::POST )
    {
      //display form
      $this->getRequest()->setAttribute('referer', $this->getRequest()->getReferer());
    }
    else 
    {
      return $this->redirect($this->getRequestParameter('referer', '@homepage'));
    } 
  }
  
  public function executeLove()
  {
    $user = $this->getUser()->getSubscriber();
    
    $love = ( $this->getRequestParameter('loves') == 1 ) ? 1 : 0;
    $id   = $this->getRequestParameter('id');
    
    $this->tag = TagPeer::retrieveByPK($id);
    $this->forward404Unless($this->tag);
    
    
    $user_tag = new UserToTag();
    $user_tag->setUser($user);
    $user_tag->setTag($this->tag);
    if ( $this->getRequestParameter('remove') )
    {
      $flag = $user_tag->delete();
    }
    else
    {
      
      $c = new Criteria;
      $c->add(UserToTagPeer::TAGS_ID, $this->tag->getId());
      $c->add(UserToTagPeer::USERS_ID, $user->getId());
      $lover = UserToTagPeer::doSelect($c);
      $new = ( $lover ) ? false : true;
      
      $user_tag->setLove($love);
      $user_tag->setNew($new);
      $flag = $user_tag->save();
    }
    
    return $flag ? sfView::SUCCESS : sfView::ERROR;
  }
  
  public function executePicture()
  {    
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);

    $this->pictures = $this->subscriber->getPictures();
  }
  
  public function executeUpload()
  {
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);

    $fileName = $this->getRequest()->getFileName('picture');
    $filePath = sfConfig::get('app_upload_folder') . DIRECTORY_SEPARATOR . $fileName;
    $this->getRequest()->moveFile('picture', $filePath);
   
    $thumbnails = sfConfig::get('app_upload_thumbnail_params');
    foreach ($thumbnails as $thumbnail)
    { 
      $image = wiImage::load(sfConfig::get('app_upload_folder') . DIRECTORY_SEPARATOR . $fileName );
      if ( $thumbnail['width'] )
      {
        $crop = ( ($image->getWidth() >= $image->getHeight()) ? $image->getHeight() : $image->getWidth() );
        $image = $image->crop(0, 0, $crop, $crop);
      }
      $resized = $image->resize($thumbnail['width'], $thumbnail['height']);
      $resized->saveToFile(sfConfig::get('app_upload_folder') . $thumbnail['dir'] . DIRECTORY_SEPARATOR . $fileName );
    }
    
    
    $user = $this->getUser()->getSubscriber();
    
    $picture = new Picture();
    $picture->setUser($user);
    $picture->setName($fileName);
    $picture->save();

    if ( $user->countPictures() == 1 )
    {
      PicturePeer::saveAvatar($user, $picture);
    }

    $this->redirect('@user_pictures');
  }
  
  public function handleError()
  {
    // both login and register
    return sfView::SUCCESS;
  }
  
  public function handleErrorUpload()
  {
    $this->forward('user', 'picture');
  }
  
  public function handleErrorProfile()
  {
    $this->user = $this->getUser()->getSubscriber();
    $this->cities = sfConfig::get('app_city');
    return sfView::SUCCESS;
  }
  
  public function executeLogout()
  {
    $this->getUser()->signOut();
   
    $this->redirect('@homepage');
  }
  
}
