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
    
    if ( $this->folder == 'inbox' )
    {
      $c = new Criteria();
      $recipent = $c->getNewCriterion(ConversationPeer::RECIPENT, $user);
      $recipent->addAnd($c->getNewCriterion(ConversationPeer::RECIPENT_IS_DELETED, 0));
      $sender = $c->getNewCriterion(ConversationPeer::SENDER, $user);
      $sender->addAnd($c->getNewCriterion(ConversationPeer::SENDER_IS_DELETED, 0));
      $sender->addAnd($c->getNewCriterion(ConversationPeer::IS_REPLIED, 1));
      $sender->addOr($recipent);
      $c->add($sender);
      
      
      $this->conversations = ConversationPeer::doSelectJoinUserRelatedBySender($c);
    }
    else
    {
      $c = new Criteria();
      $recipent = $c->getNewCriterion(ConversationPeer::SENDER, $user);
      $recipent->addAnd($c->getNewCriterion(ConversationPeer::SENDER_IS_DELETED, 0));
      $sender = $c->getNewCriterion(ConversationPeer::RECIPENT, $user);
      $sender->addAnd($c->getNewCriterion(ConversationPeer::RECIPENT_IS_DELETED, 0));
      $sender->addAnd($c->getNewCriterion(ConversationPeer::IS_REPLIED, 1));
      $sender->addOr($recipent);
      $c->add($sender);
      
      
      $this->conversations = ConversationPeer::doSelectJoinUserRelatedBySender($c);    
    }

  }
  
  public function executeRead()
  {
    $id = $this->getRequestParameter('id');
    $this->user = $this->getUser()->getSubscriberId();
    
    $c = new Criteria();
    $c->add(ConversationPeer::ID, $id);
    $sender = $c->getNewCriterion(ConversationPeer::SENDER, $this->user);
    $sender->addOr($c->getNewCriterion(ConversationPeer::RECIPENT, $this->user));
    $c->add($sender);
    $this->conversation = ConversationPeer::doSelectOne($c);
    $this->forward404Unless($this->conversation);
    
    $c = new Criteria();
    $c->add(MessagePeer::CONVERSATION_ID, $id);
    $this->messages = MessagePeer::doSelectJoinUser($c);
    $this->forward404Unless($this->messages);
      
  }
  
  public function executeReply()
  {
    // check sender
    $conversation = $this->getRequestParameter('conversation');
    $reply_to = $this->getUser()->getSubscriberByNick($this->getRequestParameter('reply_to'));
    $this->forward404Unless($reply_to);
    
    $this->subscriber = $this->getUser()->getSubscriber();

    $c = new Criteria();
    $c->add(ConversationPeer::ID, $conversation);
    $sender = $c->getNewCriterion(ConversationPeer::SENDER, $this->subscriber->getId());
    $sender->addAnd($c->getNewCriterion(ConversationPeer::RECIPENT, $reply_to->getId()));
    $recipent = $c->getNewCriterion(ConversationPeer::RECIPENT, $this->subscriber->getId());
    $recipent->addAnd($c->getNewCriterion(ConversationPeer::SENDER, $reply_to->getId()));
    $sender->addOr($recipent);
    $c->add($sender);
    $this->forward404Unless(ConversationPeer::doSelect($c));

    $this->message = new Message();
    $this->message->setWriter($this->subscriber->getId());
    $this->message->setBody($this->getRequestParameter('body'));
    $this->message->setConversationId($conversation);
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
      
      
      $message = new Message();
      $message->setConversationId($conversation->getId());
      $message->setWriter($this->getUser()->getSubscriberId());
      $message->setBody($this->getRequestParameter('body'));
      
      $message->save();
      
      $this->redirect('@conversation_read?id=' . $conversation->getId());
      
    }
  
  }
  
  public function handleErrorCompose()
  {
    return sfView::SUCCESS;
  }
}
