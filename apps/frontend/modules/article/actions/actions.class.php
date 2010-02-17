<?php

/**
 * article actions.
 *
 * @package    sf_sandbox
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class articleActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $c = new Criteria();
    $c->add(ArticlePeer::STRIPPED_TITLE, $this->getRequestParameter('stripped_title'));
    $this->article = ArticlePeer::doSelectOne($c);
    
    $this->forward404Unless($this->article);

  }
  
  public function executeList()
  {
    
    $c = new Criteria();
    $c->add(ArticlePeer::CATEGORIES_ID, 1);
    
    $pager = new sfPropelPager('Article', 10);
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->articles = $pager;
    
    
    // $this->articles = ArticlePeer::doSelect($c);  
  
  }
  
  public function executeContact()
  {
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {
      $values = array();
      $values[] = $this->getRequestParameter('fullname');
      $values[] = $this->getRequestParameter('email');
      $values[] = $this->getRequestParameter('body');
      
      $to = "berkin@kuyabiye.com";
      $subject = "kuyabiye iletişim formu";
      $body = implode("\n", $values);
      mail($to, $subject, $body);
      
      $this->setFlash('notice', 'Mesajınız alınmıştır, İlginize teşekkürler.');
      $this->redirect('@contact');
      
    }

  }
  
  public function executeInviteFriends()
  {
    if ( $this->getRequest()->getMethod() == sfRequest::POST ) 
    {
      $this->getRequest()->setAttribute('fullname', $this->getRequestParameter('fullname'));
      $this->getRequest()->setAttribute('email', $this->getRequestParameter('email'));
      $this->getRequest()->setAttribute('email2', $this->getRequestParameter('email2'));
      $this->getRequest()->setAttribute('body', $this->getRequestParameter('body'));    
      
      $raw_email = $this->sendEmail('mail', 'inviteFriends');
      $this->getLogger()->debug($raw_email);  

      $this->setFlash('notice', 'Mesajınız arkadaşınıza iletildi, İlginize teşekkürler.');
      $this->redirect('@invite_friends');
      
    }    
  }
  
  public function handleError()
  {
    return sfView::SUCCESS;
  }
}
