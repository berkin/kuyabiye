<?php
class myActivationValidator extends sfValidator
{
  public function execute (&$value, &$error)
  {
    $c = new Criteria();
    $c->add(ActivationPeer::CODE, $value);
    $activation = ActivationPeer::doSelectOne($c);
    
    
    if ( !$activation )
    {
      $error = $this->getParameter('activation_error');
      return false;    
    }
    
    if ( $activation->getAvailable() < 1 )
    {
      $error = $this->getParameter('activation_error2');
      return false;        
    }
 
    return true;
  }
 
  public function initialize ($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);
 
    // Set default parameters value
    $this->setParameter('activation_error', 'unknown activation code');
    $this->setParameter('activation_error2', 'no more left');
 
    // Set parameters
    $this->getParameterHolder()->add($parameters);
 
    return true;
  }
}