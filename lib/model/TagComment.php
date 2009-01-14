<?php

/**
 * Subclass for representing a row from the 'tags_comments' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TagComment extends BaseTagComment
{
}

$columns_map = array('left'   => TagCommentPeer::TREE_LEFT,
                     'right'  => TagCommentPeer::TREE_RIGHT,
                     'parent' => TagCommentPeer::TREE_PARENT,
                     'scope'  => TagCommentPeer::TAGS_ID);

sfPropelBehavior::add('TagComment', array('actasnestedset' => array('columns' => $columns_map)));