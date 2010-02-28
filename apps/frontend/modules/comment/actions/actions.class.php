<?php

/**
 * tagcomment actions.
 *
 * @package    sf_sandbox
 * @subpackage tagcomment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class commentActions extends sfActions
{
 
  public function executeAdd()
  {
    if ( $this->getUser()->isAuthenticated() ) 
    {
      if ( $this->getRequest()->getMethod() == sfRequest::POST)
      {

      
        $comment_id = $this->getRequestParameter('comment_id', 0);
 
        
        $tag = TagPeer::retrieveByPk($this->getRequestParameter('tag'));
        $this->forward404Unless($tag); 
      
        $body = $this->getRequestParameter('body');
        if ( !$body ) 
        {
          if ( $comment_id != 0 )
          {
            $comment = CommentPeer::retrieveByPk($comment_id);
            $page = CommentPeer::getTagPage($tag->getId(), $comment->getId(), $comment->getTreeLeft());
            $this->redirect('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=' . ($page == 1 ? '' : $page ) . '#yorum' . ($comment_id == 0 ? '' : '-' . $comment->getId()));
          }
          else 
          {
            $page = $this->getRequestParameter('page', 1);
            $this->redirect('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=' . ($page == 1 ? '' : $page ) . '#yorum-ekle');          
          }
        } 
        
        $parent_comment = 0;
        $tree_left = 0;
        $tree_right = 0;
        
        if ( $comment_id != 0 )
        {
          $c = new Criteria();
          $c->add(CommentPeer::TAGS_ID, $tag->getId());
          $c->add(CommentPeer::ID, $comment_id);
          $parent_comment = CommentPeer::doSelectOne($c);
          $tree_left = $parent_comment->getTreeLeft();
          $tree_right = $parent_comment->getTreeRight();
          $this->forward404Unless($parent_comment);
          
        }

        CommentPeer::updateCommentsTree($tree_left);
        
        $user = $this->getUser()->getSubscriber();
        $comment = new Comment();
        $comment->setUser($user);
        $comment->setTag($tag);
        $comment->setBody($body);
        $comment->setTreeLeft($tree_left + 1);
        $comment->setTreeRight($tree_left + 2);
        $comment->setParentId($comment_id);
        $comment->save();
        
        $page = CommentPeer::getTagPage($tag->getId(), $comment_id, $comment->getTreeLeft());
        
        if ( $user->getFbIsOn() && $user->getFbPublishComment() )
        {
          facebookPublishStream::publishCommentStream($user, $tag, $comment);
        }
        $this->setFlash('comment', $comment->getId());
        $this->setFlash('notice', 'Yorumunuz eklendi.');
        
        $this->redirect('@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=' . ($page == 1 ? '' : $page ) . '#yorum' . ($comment_id == 0 ? '' : '-' . $comment->getId()));
      }
    
    // redirect get requests
    $this->forward404();
    }
    else
    {
      $this->redirect('@login');
    }
  }
}
