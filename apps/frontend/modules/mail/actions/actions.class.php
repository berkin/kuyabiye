<?php

/**
 * mail actions.
 *
 * @package    sf_sandbox
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mailActions extends sfActions
{
  public function executeMessageSent()
  {
    $this->email = $this->getRequest()->getAttribute('email');
    $this->nickname = $this->getRequest()->getAttribute('nickname');
    $this->conversation = $this->getRequest()->getAttribute('conversation');
  
    $mail = new sfMail();
    $mail->addAddress($this->email);
    $mail->setFrom('From: Kuyabiye <info@kuyabiye.com>');
    $mail->setSubject($this->nickname . ' size mesaj gönderdi');

    $this->mail = $mail;
  }
  
  public function executeSendPassword()
  {
    $this->email = $this->getRequest()->getAttribute('email');
  
    $mail = new sfMail();
    $mail->addAddress($this->email);
    $mail->setFrom('From: Kuyabiye <info@kuyabiye.com>');
    $mail->setSubject('Yeni Þifre Ýsteði');

    $this->mail = $mail;  
    
    $this->password = $this->getRequest()->getAttribute('password');
  }
  
  public function executeUserRegister()
  {
    $this->email = $this->getRequest()->getAttribute('email');
    $this->nickname = $this->getRequest()->getAttribute('nickname');
    $this->conversation = $this->getRequest()->getAttribute('password');  
    
    $mail = new sfMail();
    $mail->addAddress($this->email);
    $mail->setFrom('From: Kuyabiye <info@kuyabiye.com>');
    $mail->setSubject('kuyabiye.com üyelik bilgileriniz');

    $this->mail = $mail;
  }
  
  public function executeInviteFriends()
  {
    $this->email = $this->getRequest()->getAttribute('email');
    $this->nickname = $this->getRequest()->getAttribute('fullname');
    $this->conversation = $this->getRequest()->getAttribute('body');  
    
    $mail = new sfMail();
    $mail->addAddress($this->email);
    $mail->setFrom('From: Kuyabiye <info@kuyabiye.com>');
    $mail->setSubject($this->fullname . ' size kuyabiye.com\'u tavsiye etti.');

    $this->mail = $mail;  
  }
}
