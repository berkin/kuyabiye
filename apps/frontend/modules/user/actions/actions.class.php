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
