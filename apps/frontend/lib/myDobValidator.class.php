<?php
class myDobValidator extends sfValidator
{
  public function execute (&$value, &$error)
  {
    if ( $value['day'] == '' || $value['month'] == '' || $value['year'] == '' )
    {
      $error = $this->getParameter('date_error');
      return false;
    }
    
    if ( !checkdate($value['month'], $value['day'], $value['year'] ) )
    {
      $error = $this->getParameter('date_error');
      return false;      
    }
 
    return true;
  }
 
  public function initialize ($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);
 
    // Set default parameters value
    $this->setParameter('date_error', 'invalid date');
 
    // Set parameters
    $this->getParameterHolder()->add($parameters);
 
    return true;
  }
}