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
      $c->add(ConversationPeer::OWNER, $user);
      $c->add(ConversationPeer::INBOX, true);
    }
    else
    {
      $c->add(ConversationPeer::OWNER, $user);
      $c->add(ConversationPeer::SENT, true);
    }
    $c->add(ConversationPeer::IS_DELETED, 0);    
    $c->addDescendingOrderByColumn(ConversationPeer::UPDATED_AT);
    
    $pager = new sfPropelPager('Conversation', 20);    
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->setPeerMethod( $this->folder == 'inbox' ? 'doSelectJoinUserRelatedBySender' : 'doSelectJoinUserRelatedByRecipent' );
    $pager->init();
    
    
    $this->conversations = $pager;    

  }
  
  public function executeRead()
  {
    $id = $this->getRequestParameter('id');
    $this->user = $this->getUser()->getSubscriberId();
    
    $c = new Criteria();
    $c->add(ConversationPeer::CONVERSATION, $id);
    $c->add(ConversationPeer::OWNER, $this->user);
    $this->conversation = ConversationPeer::doSelectOne($c);
    $this->forward404Unless($this->conversation);
    
    $c = new Criteria();
    $c->add(MessagePeer::CONVERSATION_ID, $id);
    $c->addAscendingOrderByColumn(MessagePeer::CREATED_AT);
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
    $c->add(ConversationPeer::OWNER, $this->subscriber->getId());
    $this->conversation = ConversationPeer::doSelectOne($c);
    $this->forward404Unless($this->conversation);
    
    $this->conversation->setSent(true);
    $this->conversation->setIsReplied(true);
    $this->conversation->save();
    
    $c = new Criteria();
    $c->add(ConversationPeer::CONVERSATION, $conversation_id);
    $c->add(ConversationPeer::OWNER, $reply_to->getId());
    $this->replied = ConversationPeer::doSelectOne($c);
    $this->forward404Unless($this->replied);

    $this->replied->setIsRead(false);
    $this->replied->setIsReplied(false);
    $this->replied->setIsDeleted(false);
    $this->replied->setInbox(true);
    $this->replied->save();
    
    $this->message = new Message();
    $this->message->setWriter($this->subscriber->getId());
    $this->message->setBody($this->getRequestParameter('body'));
    $this->message->setConversationId($this->conversation->getConversation());
    $this->message->save();
      
    //sent mail    
    $this->sendEmailNotice($reply_to->getEmail(), $reply_to->getNickname(), $this->conversation->getId());
  }
  
  public function executeCompose()
  {
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) {
      //check recipent
      $this->recipent = $this->getUser()->getSubscriberByNick($this->getRequestParameter('recipent'));
      $this->forward404Unless($this->recipent);
      
      $conversation = new Conversation();
      $conversation->setOwner($this->getUser()->getSubscriberId());
      $conversation->setSender($this->getUser()->getSubscriberId());
      $conversation->setRecipent($this->recipent->getId());
      $conversation->setTitle($this->getRequestParameter('title'));
      $conversation->setSent(true);      
      $conversation->save();
      
      $conversation->setConversation($conversation->getId());
      $conversation->save();
      
      $recipent = new Conversation();
      $recipent->setOwner($this->recipent->getId());
      $recipent->setSender($this->getUser()->getSubscriberId());
      $recipent->setRecipent($this->recipent->getId());
      $recipent->setConversation($conversation->getId());
      $recipent->setTitle($this->getRequestParameter('title'));   
      $recipent->setInbox(true);
      $recipent->save();
      
      $message = new Message();
      $message->setConversationId($conversation->getId());
      $message->setWriter($this->getUser()->getSubscriberId());
      $message->setBody($this->getRequestParameter('body'));
      
      $message->save();
      
      //sent mail    
      $this->sendEmailNotice($this->recipent->getEmail(), $this->recipent->getNickname(), $conversation->getId());
      
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
        $c->add(ConversationPeer::OWNER, $this->user);
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
  
  private function sendEmailNotice($email, $nickname, $conversation)
  {
    $this->getRequest()->setAttribute('email', $email);
    $this->getRequest()->setAttribute('nickname', $nickname);
    $this->getRequest()->setAttribute('conversation', $conversation);
    
    $raw_email = $this->sendEmail('mail', 'messageSent');
    $this->getLogger()->debug($raw_email);  
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
