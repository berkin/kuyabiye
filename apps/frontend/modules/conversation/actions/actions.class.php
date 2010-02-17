<?php

/**
 * conversation actions.
 *
 * @package    sf_sandbox
 * @subpackage conversation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $

@TODO<br />
-message read, add, index gibi kodlar silindi. galba. temizle bunlarý<br />
-giden mesajlarda çok baðlantý açýo<br />
+getUserRelatedBySender her seferinde user tablosuna baðlantý açýyor ++ ayný tabloyu iki kere join edemiyoz propel ile http://propel.phpdb.org/trac/ticket/157 þu ticketta demiþler,  http://stereointeractive.com/blog/2008/01/24/propel-criteria-left-join-using-addjoin-and-addalias-to-join-a-table-twice/ þurda bi denemesi var olmuyor, joinall deyince<br />
+kendi kendine mesaj, þizofren modu engelle<br />
+ajax 404 olmuo, opera da garip davranýyor, firefox da bi tepki veriyor en azýndan<br />
-refactoring, read de isread, reply da isreplied (ayrýca reply yapýnca öbür conversation'ýn isread ini 0 ve isreplied ini 0  yapmak lazým), compose da 2.satýr conversation ve message<br />
+pagination<br />
+send email when new message<br />
+avatar<br />
-message markdown</br>
-gelen giden mesajlara is_replied ile ilgili biþeyler ekle, doðru çalýþmýyor<br />
-isread ilk mesaj attýðýnda ters gibi<br />
-facebook gibi sent kutusu<br />
-save ederken rollback filan<br />
-you have deleted this conversation<br />
-bide mesaj okumaya girdiðinde otomatik aþaðý kaysýn mý, mesaj sayýsý çoksa nolcak, sadece son 5 mesajý filan mý göstersek, gerisini okumak için týkla filan dese?<br />
-þu mail için veri aktarmayý tek partide yapabilirsin, delicious symfony+email taginde var, array olarak göndercen<br />
-blocked<br />

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
    $this->folder = $this->getRequestParameter('folder', 'gelen');
    
    
    $c = new Criteria();
    if ( $this->folder == 'gelen' )
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
    
    $pager = new sfPropelPager('Conversation', 10);    
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

    // $this->getResponse()->addJavascript(sfConfig::get('app_jquery'));
    // $this->getResponse()->addJavascript('jquery.textarea-expander.js');
    // $this->getResponse()->addJavascript('jquery.livequery.js');

    
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
    $this->sendEmailNotice($reply_to->getEmail(), $this->getUser()->getNickname(), $this->conversation->getId());
  }
  
  public function executeCompose()
  {      
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) {
      //check recipent
      $this->recipent = $this->getUser()->getSubscriberByNick(trim($this->getRequestParameter('recipent')));
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
      $this->sendEmailNotice($this->recipent->getEmail(), $this->getUser()->getNickname(), $conversation->getId());
      
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
