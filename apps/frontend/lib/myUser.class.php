<?php

class myUser extends sfBasicSecurityUser
{
  public function signIn($user, $remember = false)
  {
    $this->setAuthenticated(true);
    $this->addCredential('subscriber');
    
    $this->setAttribute('users_id', $user->getId(), 'subscriber');
    $this->setAttribute('nickname', $user->getNickname(), 'subscriber');
    $this->setAttribute('avatar', $user->getAvatar(), 'subscriber');
    
    if ( $remember ) 
    {
      if ( !$user->getRememberKey() )
      {
        $rememberKey = myTools::generate_random_key();
        
        $user->setRememberKey($rememberKey);
        $user->save();
      }
      
      $value = base64_encode(serialize(array($user->getRememberKey(), $user->getNickname())));
      sfContext::getInstance()->getResponse()->setCookie('kuyabiye', $value, time() + 15*24*60*60, '/');
    }
  }
  
  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('subscriber');
   
    $this->setAuthenticated(false);
    $this->clearCredentials();
    
    sfContext::getInstance()->getResponse()->setCookie('kuyabiye', '', time() - 3600);
  }
    
  public function getSubscriberId()
  {
    return $this->getAttribute('users_id', '', 'subscriber');
  }
   
  public function getSubscriber()
  {
    return UserPeer::retrieveByPk($this->getSubscriberId());
  }
   
  public function getNickname()
  {
    return $this->getAttribute('nickname', '', 'subscriber');
  }
  
  public function getAvatar()
  {
    return $this->getAttribute('avatar', '', 'subscriber');
  }
  
  public function getSubscriberByNick($nick)
  {
    $c = new Criteria;
    $c->add(UserPeer::NICKNAME, $nick);
    return UserPeer::doSelectOne($c);
  }
  
}
