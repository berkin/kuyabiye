<?php

/**
 * tagcomment actions.
 *
 * @package    sf_sandbox
 * @subpackage tagcomment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tagcommentActions extends sfActions
{
 
  public function executeAdd()
  {
    if ( $this->getUser()->isAuthenticated() )
    {
      if ( $this->getRequest()->getMethod() == sfRequest::POST)
      {
        if ( !$this->getRequestParameter('body') )
        {
          return sfView::NONE;
        }
        
        $tag = TagPeer::retrieveByPk($this->getRequestParameter('tags_id'));
        $this->forward404Unless($tag);
        
        $root = TagCommentPeer::retrieveByPk(2);
        
        $this->comment = new TagComment();
        $this->comment->setBody($this->getRequestParameter('body'));
        $this->comment->insertAsFirstChildOf($root);
        $this->comment->save();
        
        return sfView::SUCCESS;
      }
      
      // redirect get requests
      $this->forward404();
    }
    else {
      $this->redirect('@login');
    }
  }
}
