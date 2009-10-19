<?php

class userdataFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if ( $this->isFirstCall() ) 
    {
      $user = sfContext::getInstance()->getUser();
      if ( $user )
      {
        $c = new Criteria();
        $c->add(ConversationPeer::IS_READ, false);
        $c->add(ConversationPeer::OWNER, $user->getSubscriberId());
        $user->setAttribute('nbUnreadMessages', ConversationPeer::doCount($c));
      }
    }
    // execute next filter
    $filterChain->execute();
  }
}