<?php

/**
 * message actions.
 *
 * @package    sf_sandbox
 * @subpackage message
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class messageActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $c = new Criteria();
    $c->add(MessagePeer::RECIPENT, $this->getUser()->getSubscriberId());

    $this->messages = MessagePeer::doSelectJoinUserRelatedBySender($c);
  }

  public function executeRead()
  {
    $id = $this->getRequestParameter('id');
    $user_id = $this->getUser()->getSubscriberId();
    $c = new Criteria();
    $c->add(MessagePeer::ID, $id);
    $or = $c->getNewCriterion(MessagePeer::SENDER, $user_id);
    $or->addOr($c->getNewCriterion(MessagePeer::RECIPENT, $user_id));
    $c->add($or);
    $this->messages = MessagePeer::doSelectJoinUserRelatedBySender($c);

    $this->forward404Unless($this->messages);


  }

  public function executeAdd()
  {
    // check sender
    $conversation = $this->getRequestParameter('conversation');
    $owner = $this->getUser()->getSubscriberByNick($this->getRequestParameter('sender'));
    $this->forward404Unless($owner);
    
    $this->subscriber = $this->getUser()->getSubscriber();

    $c = new Criteria();
    $c->add(MessagePeer::CONVERSATION, $conversation);
    $c->add(MessagePeer::SENDER, $owner->getId());
    $c->add(MessagePeer::RECIPENT, $this->subscriber->getId());
    $this->forward404Unless(MessagePeer::doSelect($c));

    $this->message = new Message();
    $this->message->setSender($this->getUser()->getSubscriberId());
    $this->message->setRecipent($owner->getId());
    $this->message->setBody($this->getRequestParameter('body'));
    $this->message->setConversation($conversation);
    $this->message->save();

  }

}
