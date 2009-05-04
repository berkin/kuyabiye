<?php

/**
 * friend actions.
 *
 * @package    sf_sandbox
 * @subpackage friend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class friendActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('friend', 'list');
  }

  public function executeAdd()
  {
    // find friend, check if exists
    $this->user_to = $this->getUser()->getSubscriberByNick($this->getRequestParameter('user'));
    $this->forward404Unless($this->user_to);
    $user_from = $this->getUser()->getSubscriberId();

    $c = new Criteria();
    $c->add(FriendPeer::USER_FROM, $user_from);
    $c->add(FriendPeer::USER_TO, $this->user_to->getId());
    $friend = FriendPeer::doSelect($c);

    if ( empty($friend) ) {
      $friend = new Friend();
    }
    $friend->setUserFrom($this->getUser()->getSubscriberId());
    $friend->setUserTo($this->user_to->getId());

    $task = $this->getRequestParameter('task', 'none');

    if ( $task == 'approve' )
    { 
      // change status to 1, and save the friend
      $c = new Criteria();
      $c->add(FriendPeer::USER_FROM, $this->user_to->getId());
      $c->add(FriendPeer::USER_TO, $user_from);
      $approve_friend = FriendPeer::doSelectOne($c); 

      if ( $approve_friend ) 
      {
        $approve_friend->setStatus(1);
        $approve_friend->save();
      }

      $friend->setStatus(1);
    }
    elseif ( $task == 'disapprove' )
    {
      // change status to 1, and save the friend
      $c = new Criteria();
      $c->add(FriendPeer::USER_FROM, $this->user_to->getId());
      $c->add(FriendPeer::USER_TO, $user_from);
      $disapprove_friend = FriendPeer::doSelectOne($c); 
      $disapprove_friend->delete();

      $flag = $friend->delete();
      return $flag ? sfView::SUCCESS : sfView::ERROR;    
    }

    $flag = $friend->save();

    return $flag ? sfView::SUCCESS : sfView::ERROR;    
  }

  public function executeList()
  {
    $c = new Criteria();
    $c->add(FriendPeer::USER_FROM, $this->getUser()->getSubscriberId());
    $c->add(FriendPeer::STATUS, 1);
    $c->addJoin(FriendPeer::USER_TO, UserPeer::ID);
    
    $this->friends = FriendPeer::doSelectJoinUserRelatedByUserTo($c);
  }

  public function executeRequest()
  {
    $c = new Criteria();
    $c->add(FriendPeer::USER_TO, $this->getUser()->getSubscriberId());
    $c->add(FriendPeer::STATUS, 0);
    $c->addJoin(FriendPeer::USER_FROM, UserPeer::ID);
    
    $this->friends = FriendPeer::doSelectJoinUserRelatedByUserFrom($c);
  }

  public function handleError()
  {
    return sfView::SUCCESS;
  }
}
