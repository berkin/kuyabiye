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
    
    $this->owner = ( $this->subscriber->getNickname() == $this->getUser()->getNickname() ) ? true : false;
    
    if ( $this->getRequest()->getMethod() == sfRequest::POST && $this->owner ) 
    {
      $this->subscriber->setQuote($this->getRequestParameter('quote'));
      $this->subscriber->save();
      
      //facebook      
      if ( $this->subscriber->getFbIsOn() && $this->subscriber->getFbPublishStatus() )
      {
        facebookPublishStream::publishStatusStream($this->subscriber, $this->subscriber->getQuote());
      }

      $this->setFlash('notice', 'Güncellendi.');
      $this->redirect('@user_profile?nick=' . $this->getUser()->getNickname());
    }
    
    
    $this->loved_tags = $this->subscriber->getUserToTagsJoinTag();
    $this->hated_tags = $this->subscriber->getUserToTagsJoinTag(false);
    // $this->comments = $this->subscriber->getCommentsJoinTag();
    
    $response = $this->getResponse();
    $response->setTitle($this->subscriber->getNickname()  . ' - kuyabiye.com');
    
    $user_id = $this->subscriber->getId();
    $c = new Criteria();
    $c->add(PicturePeer::USER_ID, $user_id);
    $this->nbPictures = PicturePeer::doCount($c);    
    
    //harmony
    $this->common_tags = array();
    $this->harmony = 20;
    if ( !$this->owner )
    {
      $this->common_tags = UserToTagPeer::getCommonTags($this->subscriber->getId(), $this->getUser()->getSubscriberId());
      
      $this->harmony += (count($this->tags) * 5);
      
      $this->harmony = ( $this->harmony > 90 ? 90 : $this->harmony);

    }
    
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
    
    //harmony
    $this->common_tags = array();
    $this->harmony = 20;
    if ( !$this->owner )
    {
      $this->common_tags = UserToTagPeer::getCommonTags($this->subscriber->getId(), $this->getUser()->getSubscriberId());
      
      $this->harmony += (count($this->tags) * 5);
      
      $this->harmony = ( $this->harmony > 90 ? 90 : $this->harmony);

    }
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
      $user = new User();
      $_dob = $this->getRequestParameter('dob');
      $dob = $_dob['year'] . '-' . $_dob['month'] . '-' . $_dob['day'];
      $user->setNickname($this->getRequestParameter('nickname'));
      $user->setEmail($this->getRequestParameter('email'));
      $user->setPassword($this->getRequestParameter('password'));
      $user->setFirstname($this->getRequestParameter('firstname'));
      $user->setLastname($this->getRequestParameter('lastname'));
      $user->setGender($this->getRequestParameter('gender'));
      $user->setDob($dob);
      
      if ( sfConfig::get('app_activation_is_on') )
      {
        $c = new Criteria();
        $c->add(ActivationPeer::CODE, $this->getRequestParameter('activation'));
        $activation = ActivationPeer::doSelectOne($c);      
        $user->setActivationCode($activation->getId());
      }
      
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
      $city = $this->getRequestParameter('city');
      if ( $this->getRequestParameter('country') == 'TR' && !$city )
      {
        $this->getRequest()->setError('city', 'Şehir girmeniz gerekli');
      }

      if ( $city )
      {
        if ( !array_key_exists($city, $this->cities) )
        {
          $this->getRequest()->setError('city', 'Hatalı şehir');
        }
      }
      $this->updateProfileFromRequest();
      $this->user->save();
      
      $this->setFlash('notice', 'Profiliniz güncellendi.');
    }    
  }
  
  public function executeUserEdit()
  {
    $this->user = $this->getUser()->getSubscriber();
    
  }
  
  public function executeFacebookSettings()
  {
    $this->user = $this->getUser()->getSubscriber();
    
    // save user
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {
      $this->user->setFbPublishStatus($this->getRequestParameter('fb_publish_status'));
      $this->user->setFbPublishLove($this->getRequestParameter('fb_publish_love'));
      $this->user->setFbPublishComment($this->getRequestParameter('fb_publish_comment'));
      $this->user->save();
      
      $this->setFlash('notice', 'Ayarlarınız güncellendi.');
    }    
  }
  
  public function executeFacebook()
  {
    $this->facebook = 'xmlns:fb="http://www.facebook.com/2008/fbml"';
    $this->user = $this->getUser()->getSubscriber();
     
    // user has granted the permissions, we display "facebook and kuyabiye connected successfully" and we can display a sharing checboxes(loves, comments, status)
    // if the user did not grant the permissions, we show connect to facebook button
    // we will get the has_permission_stream and has_permission_offline values using the session_key and uuid
    $appapikey = sfConfig::get('app_facebook_api_key');
    $appsecret = sfConfig::get('app_facebook_api_secret');
    $facebook = new Facebook($appapikey, $appsecret);
    
    if ( $this->getRequestParameter('save_user') )
    {
      $this->user->setFbIsOn(true);
      $this->user->setFbUuid($facebook->api_client->users_getLoggedInUser());
      $this->user->setFbSessionKey($facebook->api_client->session_key);
      $this->user->save();
      $this->redirect('@facebook');
    }    
    
    $this->has_permission_stream = $this->has_permission_offline = false;
    
    if ( $this->user->getFbIsOn() )
    {
      // check the database that user has a session key?
      $facebook->set_user($this->user->getFbUuid(), $this->user->getFbSessionKey());

      if ( $this->getRequestParameter('passive') )
      {
        $facebook->api_client->auth_revokeExtendedPermission('publish_stream');
        $facebook->api_client->auth_revokeExtendedPermission('offline_access');
        
        $this->user->setFbIsOn('false');
        $this->user->setFbUuid('');
        $this->user->setFbSessionKey('');
        $this->user->save();
        
        $this->redirect('@facebook');
      }
      
      // store these at database
      $this->facebook_user = $facebook->get_loggedin_user();
      // print_r($facebook->api_client->users_getInfo($this->user->getFbUuid(), 'pic_square_with_logo, sex, first_name, last_name'));

      
      if ( $this->facebook_user )
      {
        //check for publish stream permission
        $this->has_permission_stream = $facebook->api_client->users_hasAppPermission("publish_stream");


        //check for offline access
        $this->has_permission_offline = $facebook->api_client->users_hasAppPermission("offline_access"); 
      }
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
      
      //facebook      
      if ( $user->getFbIsOn() && $user->getFbPublishLove() )
      {
        facebookPublishStream::publishLoveStream($user, $this->tag, $love);
      }
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
    $this->forward404Unless($this->picture);
    
    PicturePeer::saveAvatar($user, $this->picture->getName());
    
    $this->setFlash('notice', 'Seçtiğiniz resim avatarınız olarak kaydedildi.');
    $this->redirect('@user_pictures?nick=' . $user->getNickname());
  }
  
  public function executeUpload()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $this->redirect('@user_pictures?nick=' . $this->getUser()->getNickname());
    }

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
    $fileExt = strtolower(substr($cacheFileName, strrpos($cacheFileName, '.') + 1));
    $fileName = time() . rand(100000, 999999) . '.' . $fileExt;
    $filePath = sfConfig::get('app_upload_folder') . DIRECTORY_SEPARATOR . $fileName;
    $this->getRequest()->moveFile('picture', $filePath);
   
    $thumbnails = sfConfig::get('app_upload_thumbnail_params');

    foreach ($thumbnails as $thumbnail)
    { 
    
      $image = WideImage::load(sfConfig::get('app_upload_folder') . DIRECTORY_SEPARATOR . $fileName );

      if ( $thumbnail['height'] )
      {
        $crop = ( ($image->getWidth() >= $image->getHeight()) ? $image->getHeight() : $image->getWidth() );
        $image = $image->crop('center', 'center', $crop, $crop);
      }
      
      $compression = ( $fileExt == 'png' ? '6' : '80' );
      $resized = $image->resize($thumbnail['width'], $thumbnail['height']);
      $resized->saveToFile(sfConfig::get('app_upload_folder') . $thumbnail['dir'] . DIRECTORY_SEPARATOR . $fileName, $compression);
      
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
   
      $this->getRequest()->setAttribute('email', $user->getEmail());
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
