<?php

/**
 * user actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 

@todo<br />
  * nickname, do not begin or end with space, do not contain more than 1 space between words. validate class must be external<br />
  * email kontrol
  
 */
class userActions extends sfActions
{
  public function executeShow()
  {
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);

    $this->loved_tags = $this->subscriber->getUserToTagsJoinTag();
    $this->hated_tags = $this->subscriber->getUserToTagsJoinTag(false);
    // $this->comments = $this->subscriber->getCommentsJoinTag();
    
    $response = $this->getResponse();
    $response->setTitle($this->subscriber->getNickname()  . ' - kuyabiye.com');
    
    $c = new Criteria();
    $c->add(PicturePeer::USER_ID, $this->subscriber->getId());
    $this->nbPictures = PicturePeer::doCount($c);
    
    $this->owner = ( $this->subscriber->getNickname() == $this->getUser()->getNickname() ) ? true : false;
  }

  public function executeTags()
  {
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);  

    $this->sense = $this->getRequestParameter('sense', 'hepsi');
    $this->forward404Unless(array_key_exists($this->sense, sfConfig::get('app_sense')));
    
    $this->tags = UserToTagPeer::getUserTagsPager($this->subscriber, $this->sense, $this->getRequestParameter('page', 1));
    
    $c = new Criteria();
    $c->add(PicturePeer::USER_ID, $this->subscriber->getId());
    $this->nbPictures = PicturePeer::doCount($c);
    
    $this->owner = ( $this->subscriber->getNickname() == $this->getUser()->getNickname() ) ? true : false;
  }
  
  public function executeRegister()
  {
    if ( $this->getUser()->isAuthenticated() ) 
    {
      $this->redirect('@homepage');
    }
  
    // save user
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {    
      $c = new Criteria();
      $c->add(ActivationPeer::CODE, $this->getRequestParameter('activation'));
      $activation = ActivationPeer::doSelectOne($c);

      $user = new User();
      
      $user->setNickname($this->getRequestParameter('nickname'));
      $user->setEmail($this->getRequestParameter('email'));
      $user->setPassword($this->getRequestParameter('password'));
      $user->setFirstname($this->getRequestParameter('firstname'));
      $user->setLastname($this->getRequestParameter('lastname'));
      $user->setActivationCode($activation->getId());
      
      $user->save();
      
      $activation->setAvailable($activation->getAvailable() - 1);
      $activation->save();
      
      //sent mail    
      $this->sendEmailNotice($user->getEmail(), $user->getNickname(), $this->getRequestParameter('password'));
      
      $this->getUser()->signIn($user);
      $this->redirect('@user_profile?nick=' . $this->getUser()->getNickname());
    }

  }
  
  public function executeProfile()
  {
    $this->user = $this->getUser()->getSubscriber();
    $this->cities = sfConfig::get('app_city');

    // save user
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {
      $this->updateProfileFromRequest();
      $this->user->save();
      
      $this->setFlash('notice', 'Profiliniz güncellendi.');
    }    
  }
    
  public function executeLogin()
  {
    $user = $this->getUser();
    $request = $this->getRequest();
    if ( $request->getMethod() != sfRequest::POST )
    {
      //display form
      $request->setAttribute('comment', (int)str_replace('yorum-', '', $this->getRequestParameter('link')));
      $request->setAttribute('referer', $user->getAttribute('refererUri'));
    }
    else 
    {
      if ( $user->hasAttribute('search') )
      {
        $this->setFlash('search', $user->getAttribute('search'));
        $request->getAttributeHolder()->remove('search');
      }
      $this->setFlash('redirected', $this->getRequestParameter('comment'));
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
    $this->setFlash('tag_notice', 'Seçiminiz kaydedildi.');
    $this->redirect('@tag?stripped_tag=' . $this->tag->getStrippedTag() . '&page=');
  }
  
  public function executePicture()
  {    
  
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);

    $this->pictures = $this->subscriber->getPictures();
    
    if ( count($this->pictures) ) 
    {
      $this->getResponse()->addJavascript(sfConfig::get('app_jquery'));
      $this->getResponse()->addJavascript('lightbox');
      $this->getResponse()->addStylesheet('lightbox');    
    }
    
    $this->owner = ( $this->subscriber->getNickname() == $this->getUser()->getNickname() ) ? true : false;
  }
  
  public function executePictureRemove()
  {
    $user = $this->getUser()->getSubscriber();
    
    $picture = PicturePeer::getUserPicture($user, $this->getRequestParameter('id'));
    if ( $user->getAvatar() == $picture->getName() )
    {
      $user->setAvatar('');
      $user->save();
    }
    $picture->delete();
    
    $this->setFlash('notice', 'Resminiz silindi.');
    $this->redirect('@user_pictures?nick=' . $user->getNickname());
  }
  
  public function executePictureSetAvatar()
  {
    $user = $this->getUser()->getSubscriber();

    $this->picture = PicturePeer::getUserPicture($user, $this->getRequestParameter('id'));
    
    PicturePeer::saveAvatar($user, $this->picture->getName());
    
    $this->setFlash('notice', 'Seçtiğiniz resim avatarınız olarak kaydedildi.');
    $this->redirect('@user_pictures?nick=' . $user->getNickname());
  }
  
  public function executeUpload()
  {
    $this->subscriber = $this->getUser()->getSubscriberByNick($this->getRequestParameter('nick', $this->getUser()->getNickname()));
    $this->forward404Unless($this->subscriber);
    
    $c = new Criteria();
    $c->add(PicturePeer::USER_ID, $this->subscriber->getId());
    $this->nbPictures = PicturePeer::doCount($c);
    
    if ( $this->nbPictures >= 20 )
    {
      $this->getRequest()->setError('picture', 'En fazla 20 adet resim yükleyebilirsiniz.');
      $this->forward('user', 'picture');
    }
    else
    {
    
    $cacheFileName = $this->getRequest()->getFileName('picture');
    $fileName = time() . rand(100000, 999999) . '.' . strtolower(substr($cacheFileName, strrpos($cacheFileName, '.') + 1));
    $filePath = sfConfig::get('app_upload_folder') . DIRECTORY_SEPARATOR . $fileName;
    $this->getRequest()->moveFile('picture', $filePath);
   
    $thumbnails = sfConfig::get('app_upload_thumbnail_params');

    foreach ($thumbnails as $thumbnail)
    { 
    
      $image = WideImage::load(sfConfig::get('app_upload_folder') . DIRECTORY_SEPARATOR . $fileName );

      if ( $thumbnail['height'] )
      {
        $crop = ( ($image->getWidth() >= $image->getHeight()) ? $image->getHeight() : $image->getWidth() );
        $image = $image->crop(0, 0, $crop, $crop);
      }
      $resized = $image->resize($thumbnail['width'], $thumbnail['height']);
      $resized->saveToFile(sfConfig::get('app_upload_folder') . $thumbnail['dir'] . DIRECTORY_SEPARATOR . $fileName, null);
      
      //avoid memory limit exceed
      unset($image);
    }
        
    $picture = new Picture();
    $picture->setUser($this->subscriber);
    $picture->setName($fileName);
    $picture->save();

    if ( $this->subscriber->countPictures() == 1 )
    {
      PicturePeer::saveAvatar($this->subscriber, $picture);
    }
    
    }

    $this->redirect('@user_pictures?nick=' . $this->subscriber->getNickname());
  }
  
  public function executePasswordRequest()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      // display the form
      return sfView::SUCCESS;
    }
   
    // handle the form submission
    $c = new Criteria();
    $c->add(UserPeer::EMAIL, $this->getRequestParameter('email'));
    $user = UserPeer::doSelectOne($c);
   
    // email exists?
    if ($user)
    {
      // set new random password
      $password = substr(md5(rand(100000, 999999)), 0, 6);
      $user->setPassword($password);
   
      $this->getRequest()->setAttribute('password', $password);
      $this->getRequest()->setAttribute('nickname', $user->getNickname());
   
      $raw_email = $this->sendEmail('mail', 'sendPassword');
      $this->logMessage($raw_email, 'debug');
   
      // save new password
      $user->save();
   
      return 'MailSent';
    }
    else
    {
      $this->getRequest()->setError('email', 'E-posta adresiniz kayıtlarımızda yer almıyor.');
   
      return sfView::SUCCESS;
    }  
  }
  
  private function sendEmailNotice($email, $nickname, $password)
  {
    $this->getRequest()->setAttribute('email', $email);
    $this->getRequest()->setAttribute('nickname', $nickname);
    $this->getRequest()->setAttribute('password', $password);
    
    $raw_email = $this->sendEmail('mail', 'userRegister');
    $this->getLogger()->debug($raw_email);  
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
    
    $this->updateProfileFromRequest();
    
    $response = $this->getContext()->getResponse();
    $response->addJavascript('tools');

    return sfView::SUCCESS;
  }
  
  private function updateProfileFromRequest()
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
    $dob = $this->getRequestParameter('dob');
    if ( $dob['day'] == '' && $dob['month'] == '' && $dob['year'] == '' ) 
    {
      $date = null;
    }
    else 
    {
      $date = implode('-', $dob);
    }
    $this->user->setDob($date);    
  }
  
  public function executeLogout()
  {
    $this->getUser()->signOut();
   
    $this->redirect('@homepage');
  }
  
}
