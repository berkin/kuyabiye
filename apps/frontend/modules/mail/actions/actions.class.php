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
}
