<?php
  class myLoginValidator extends sfValidator
  {
    public function initialize($context, $parameters = null)
    {
      parent::initialize($context);
      
      // set default
      $this->setParameter('login_error', 'Invalid Input');
      $this->getParameterHolder()->add($parameters);
      
      return true;
    }
    
    public function execute(&$value, &$error)
    {
      $password_param = $this->getParameter('password');
      $password = $this->getContext()->getRequest()->getParameter($password_param);
      
      $login = $value;
      
      $c = new Criteria();
      $c_email = $c->getNewCriterion(UserPeer::EMAIL, $login);
      $c_nickname = $c->getNewCriterion(UserPeer::NICKNAME, $login);
      $c_email->addOr($c_nickname);
      $c->add($c_email);
      // $c->add(UserPeer::NICKNAME, $login);
      $user = UserPeer::doSelectOne($c);
      
      // nickname exists?
      if ( $user ) 
      {        
        // password is ok?
        if ( sha1($user->getSalt() . $password) == $user->getSha1Password() ) 
        {
          $remember_param = $this->getParameter('remember');
          $remember = $this->getContext()->getRequest()->getParameter($remember_param);
          $remember = ( $remember ) ? true : false;
          $this->getContext()->getUser()->signIn($user, $remember);
         
          return true;
        }
      }
      
      $error = $this->getParameter('login_error');
      return false;
      
    }
    
  }