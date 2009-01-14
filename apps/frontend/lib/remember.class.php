<?php

class rememberFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if ( $this->isFirstCall() ) 
    {
      if ( $cookie = $this->getContext()->getRequest()->getCookie('kuyabiye') )
      {
        $value = unserialize(base64_decode($cookie));
        
        $c = new Criteria();
        $c->add(UserPeer::REMEMBER_KEY, $value[0]);
        $c->add(UserPeer::NICKNAME, $value[1]);
        
        $user = UserPeer::doSelectOne($c);
        if ( $user ) 
        {
          $this->getContext()->getUser()->signIn($user);
        }
      }
    }
    // execute next filter
    $filterChain->execute();
  }
}