<?php

/**
 * conversation actions.
 *
 * @package    sf_sandbox
 * @subpackage conversation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class conversationActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

    $response = $this->getContext()->getResponse();
    $response->addJavascript('tools');

    $user = $this->getUser()->getSubscriberId();
    $this->folder = $this->getRequestParameter('folder', 'inbox');
    
    $c = new Criteria();
    if ( $this->folder == 'inbox' )
    {
      $c->add(ConversationPeer::RECIPENT, $user);
    }
    else
    {
      $c->add(ConversationPeer::SENDER, $user);
    }
    $c->add(ConversationPeer::IS_DELETED, 0);    
    
    $this->conversations = ConversationPeer::doSelectJoinUserRelatedBySender($c);    

  }
  
  public function executeRead()
  {
    $id = $this->getRequestParameter('id');
    $this->user = $this->getUser()->getSubscriberId();
    
    $c = new Criteria();
    $c->add(ConversationPeer::CONVERSATION, $id);
    $c->add(ConversationPeer::RECIPENT, $this->user);
    $this->conversation = ConversationPeer::doSelectOne($c);
    $this->forward404Unless($this->conversation);
    
    $c = new Criteria();
    $c->add(MessagePeer::CONVERSATION_ID, $id);
    $this->messages = MessagePeer::doSelectJoinUser($c);
    $this->forward404Unless($this->messages);
    
    $this->conversation->setIsRead(true);
    $this->conversation->save();
  }
  
  public function executeReply()
  {
    // check sender
    $conversation_id = $this->getRequestParameter('conversation');
    $reply_to = $this->getUser()->getSubscriberByNick($this->getRequestParameter('reply_to'));
    $this->forward404Unless($reply_to);
    
    $this->subscriber = $this->getUser()->getSubscriber();

    $c = new Criteria();
    $c->add(ConversationPeer::CONVERSATION, $conversation_id);
    $c->add(ConversationPeer::SENDER, $reply_to->getId());
    $c->add(ConversationPeer::RECIPENT, $this->subscriber->getId());
    $this->conversation = ConversationPeer::doSelectOne($c);
    $this->forward404Unless($this->conversation);
    
    $this->conversation->setIsReplied(true);
    $this->conversation->save();

    $this->message = new Message();
    $this->message->setWriter($this->subscriber->getId());
    $this->message->setBody($this->getRequestParameter('body'));
    $this->message->setConversationId($this->conversation->getId());
    $this->message->save();
  }
  
  public function executeCompose()
  {
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) {
      //check recipent
      $this->recipent = $this->getUser()->getSubscriberByNick($this->getRequestParameter('recipent'));
      $this->forward404Unless($this->recipent);
      
      $conversation = new Conversation();
      $conversation->setSender($this->getUser()->getSubscriberId());
      $conversation->setRecipent($this->recipent->getId());
      $conversation->setTitle($this->getRequestParameter('title'));
      
      $conversation->save();
      
      $conversation->setConversation($conversation->getId());
      $conversation->save();
      
      $recipent = new Conversation();
      $recipent->setSender($this->recipent->getId());
      $recipent->setRecipent($this->getUser()->getSubscriberId());
      $recipent->setConversation($conversation->getId());
      $recipent->setTitle($this->getRequestParameter('title'));      
      $recipent->save();
      
      $message = new Message();
      $message->setConversationId($conversation->getId());
      $message->setWriter($this->getUser()->getSubscriberId());
      $message->setBody($this->getRequestParameter('body'));
      
      $message->save();
      
      $this->redirect('@conversation_read?id=' . $conversation->getConversation());
      
    }
  
  }
  
  public function executeRemove()
  {
    $conversations = $this->getRequestParameter('messages');
    
    if ( is_array($conversations) )
    {
      foreach ( $conversations as $conversation )
      {
        $this->user = $this->getUser()->getSubscriberId();

        $c = new Criteria();
        $c->add(ConversationPeer::CONVERSATION, $conversation);
        $c->add(ConversationPeer::RECIPENT, $this->user);
        $conversation = ConversationPeer::doSelectOne($c);
        $this->forward404Unless($conversation);

        $conversation->setIsDeleted(true);
        $conversation->save();
        
        $this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
        $this->getResponse()->setHttpHeader('X-JSON', json_encode($conversations));

      }
    }
    return sfView::HEADER_ONLY; 
  }
  
  public function handleErrorCompose()
  {
    return sfView::SUCCESS;
  }
  
  public function handleErrorReply()
  {
    return sfView::NONE;
  }
}
