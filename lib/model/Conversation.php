<?php

/**
 * Subclass for representing a row from the 'conversations' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Conversation extends BaseConversation
{
  public function getReplyTo()
  {
    $user = sfContext::getInstance()->getUser();
    
    if ( $this->getSender() == $user->getSubscriberId() )
    {
      $nickname = $this->getUserRelatedByRecipent()->getNickname();
    }
    else {
      $nickname = $this->getUserRelatedBySender()->getNickname();    
    }
    
    return $nickname;
  }
  
}
