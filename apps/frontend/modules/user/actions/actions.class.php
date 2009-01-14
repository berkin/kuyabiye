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
    $love = $this->getRequestParameter('loves');
    $id   = $this->getRequestParameter('id');
    
    $this->tag = TagPeer::retrieveByPK($id);
    $this->forward404Unless($this->tag);
    
    $user = $this->getUser()->getSubscriber();
    
    // delete existing love
    UserToTagPeer::removeLove($user, $this->tag);
    
    // insert new love    
    if ( isset($love) ) 
    {
      $user_tag = new UserToTag();
      $user_tag->setUser($user);
      $user_tag->setTag($this->tag);
      $user_tag->setLove($love);
      $user_tag->save();
    }
  }
  
  public function handleError()
  {
    // both login and register
    return sfView::SUCCESS;
  }
  
  public function executeLogout()
  {
    $this->getUser()->signOut();
   
    $this->redirect('@homepage');
  }
  
}
