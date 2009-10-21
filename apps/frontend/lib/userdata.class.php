<?php

class userdataFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if ( $this->isFirstCall() ) 
    {
      $user = sfContext::getInstance()->getUser();
      if ( $user->isAuthenticated() )
      {
        $user_id = $user->getSubscriberId();
        $c = new Criteria();
        $c->add(ConversationPeer::IS_READ, false);
        $c->add(ConversationPeer::OWNER, $user_id);
        $user->setAttribute('nbUnreadMessages', ConversationPeer::doCount($c));
        
        $c = new Criteria();
        $c->add(FriendPeer::USER_TO, $user_id);
        $c->add(FriendPeer::STATUS, 0);
        $user->setAttribute('nbFriendRequests', FriendPeer::doCount($c));
      }
      else
      {
        $request = sfContext::getInstance()->getRequest();
        if ( $request->getParameter('action') != 'login' )
        {
          $user->setAttribute('refererUri', $request->getUri());
          
          if ( $request->getParameter('module') == 'tag' && $request->getParameter('action') == 'search' ) {
            $user->setAttribute('search', $request->getParameter('search'));
          }
        }      
      }
    }
    // execute next filter
    $filterChain->execute();
  }
}