<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05

use_helper('Date', 'Validation', 'User', 'Pagination', 'Javascript');
?>
      <ul class="breadcrumb">
        <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
        <li><a href="#">Etiketler</a></li>
      </ul>
        
      <?php include_partial('tag/tag', array('tag' => $tag)) ?>

        
			<div id="scale" class="clearfix">
      	<div class="users-links">
          <?php echo link_to('İlgi Metre', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=hepsi&page=', 'class=left') ?>
          <?php echo link_to('sevenler(' . $tag->getLovers() . '),', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevenler&page=', array('class' => 'love')) ?>
          <?php echo link_to('sevmeyenler(' . $tag->getHaters() . '),', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevmeyenler&page=', array('class' => 'hate')) ?>
          <?php echo link_to('hepsi(' . $tag->getTotal() . ')', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=hepsi&page=') ?>   
        </div>
        <?php if ( $total > 10 ) { ?>
        <div class="lovers clearfix">
          <?php if ( $lovers ) { ?>
    	    <ul class="users clearfix">
            <?php $last = end($lovers); foreach ( $lovers as $lover ) { ?>
              <li <?php echo ( $lover == $last ? 'class="last"' : '' ) ?>><?php include_partial('user/avatar', array( 'user' => $lover )) ?></li>
            <?php } ?>
    	    </ul>
    		  <div class="users-percent">
            <?php 
            if ( $total > 10 )
            {
              echo link_to('%' . $percents['lovers'] . ( count($lovers) > 1 ? ' seviyor' : ''), '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=lovers', array('class' => 'love'));
            }?>
       		</div>
          <?php } else { ?>
          <div class="empty">&nbsp;</div>
          <?php } ?>
        </div>
        <div class="haters clearfix">
          <?php if ( $haters ) { ?>
          <ul class="users clearfix">
            <?php $last = end($haters); foreach ( $haters as $hater ) { ?>
            <li <?php echo ( $hater == $last ? 'class="last"' : '' ) ?>><?php include_partial('user/avatar', array( 'user' => $hater )) ?></li>
            <?php } ?>
    		  </ul>
          <div class="users-percent">
            <?php 
            if ( $total > 10 ) {
              echo link_to('%' . $percents['haters']. ( count($haters) > 1 ? ' sevmiyor' : '' ), '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=lovers', array('class' => 'hate'));
              }
            ?>
          </div>
          <?php } else { ?>
          <div class="empty">&nbsp;</div>
          <?php } ?>
        </div>
        <?php } else { ?>
          <div class="lack">
            <p>Henüz yeterli sayıda üyeden ilgi görmemiş.</p>
          </div>
        <?php } ?>
      </div>
      
      <div id="yorum" class="comments">
      	<h2 class="love sub-header">Yorumlar (<?php echo $tag->getNbComments() ?>)</h2>
        <?php foreach ( $comments->getResults() as $comment ) { ?>
          <?php $comment = array_change_key_case($comment); ?>
          <?php include_partial('comment/comment', array('comment' => $comment, 'tag' => $tag->getId())) ?>
        <?php } ?>
        <div id="yorum-ekle" class="comment no-border">
          <?php if ( $sf_user->isAuthenticated() ) { ?>
          <?php include_partial('user/avatar', array('user' => $sf_user)) ?>
          <div class="comment-main-form">
          <form name="main-comment" action="<?php echo url_for('@add_comment'); ?>" method="post" class="comment-reply-form">
            <?php
              echo input_hidden_tag('page', $page);
              echo input_hidden_tag('tag', $tag->getId());
              echo textarea_tag('body');
            ?>
            <div class="form-submit clearfix">
              <div class="submit-button">
                <?php echo submit_image_tag('reply-button.gif'); ?>
              </div> 
              <?php include_partial('conversation/markdown_help'); ?>
            </div>
          </form>   
          </div>
          <?php } else { ?>
            <div class="notice">Yorum yapmak için <?php echo link_to('üye girişi', '@login', 'class=love'); ?> yapmalısınız. Üye değilseniz, <?php echo link_to('üye olmak', '@register', 'class=love') ?> çok kolay!</div>
          <?php } ?>
        </div>
      
      </div>
      <?php echo pager_navigation($comments, '@tag?stripped_tag=' . $tag->getStrippedTag()); ?>
      
<?php
if ( $sf_user->isAuthenticated() )
{
  echo javascript_tag("function showReply(comment_id) 
    {
      var aHref = 'href-' + comment_id;
      var objHref = $(aHref);
      var commentHolder = 'comment-' + comment_id;
      var objCommentHolder = $(commentHolder);
      var commentFormHolder = $('comment-form-' + comment_id);
      var objCommentFormHolder = $(commentFormHolder);
      
      if ( objCommentFormHolder ) 
      {
        if ( objCommentFormHolder.style.display == 'none' ) {
          new Effect.BlindDown(commentFormHolder, { duration: 0.2 });
          objHref.innerHTML = 'yorum yaz';
        } 
        else {
          new Effect.BlindUp(commentFormHolder, { duration: 0.2 });
          objHref.innerHTML = 'yorum yaz';
        }
      }
      else 
      {
        var commentForm = '<form action=\"" . url_for('@add_comment') . "\" method=\"post\" class=\"comment-reply-form\" id=\"comment-form-' + comment_id + '\">\
                              <input type=\"hidden\" name=\"tag\" value=\"" . $tag->getId() . "\">\
                              <input type=\"hidden\" name=\"comment_id\" value=\"' + comment_id + '\">\
                              <textarea name=\"body\"><\/textarea>" . submit_image_tag('reply-button.gif') . "\
                           <\/form>';
        new Insertion.After(commentHolder, commentForm);
        new Effect.BlindDown('comment-form-' + comment_id, { duration: 0.2 });          
        objHref.innerHTML = 'yorum yaz';
      }
    }
  ");
}
?>