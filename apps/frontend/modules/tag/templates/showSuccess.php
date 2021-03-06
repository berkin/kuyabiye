<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05

use_helper('Date', 'Validation', 'User', 'Pagination', 'Javascript');
?>
      <ul class="breadcrumb">
        <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
        <li><a href="#">Etiketler</a></li>
      </ul>
        
      <?php include_partial('tag/tag', array('tag' => $sf_data->get('tag'))) ?>

        
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
              echo textarea_tag('body', '', 'class=expand50-500');
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
  echo javascript_tag("$(document).ready(function(){
      $('a.comment-reply-link').click(function() {
      var comment_id = $(this).attr('id').replace('href-', '');
      if ( !document.getElementById('comment-form-' + comment_id) )
      {
      var commentForm = '<form action=\"" . url_for('@add_comment') . "\" method=\"post\" class=\"comment-reply-form\" id=\"comment-form-' + comment_id + '\" style=\"display: none;\">\
                            <input type=\"hidden\" name=\"tag\" value=\"" . $tag->getId() . "\">\
                            <input type=\"hidden\" name=\"comment_id\" value=\"' + comment_id + '\">\
                            <textarea class=\"expand50-500\" id=\"comment-form-textarea-' + comment_id + '\" name=\"body\"><\/textarea>\
                            <div class=\"form-submit clearfix\">\
                              <div class=\"submit-button\">\
                                " . submit_image_tag('reply-button.gif') . "\
                              <\/div>\
                              <div class=\"small\">\
                              " . link_to('Mesajınızı düzenlemeniz için gerekli bilgiler', "#", 'class=toggle-markdown') . "\
                              <\/div>\
                              <div class=\"formatting-help\" style=\"display: none\">\
                                <h6 class=\"first\">Etiklet Linkleme:<\/h6>\
                                <p>**kuyabiye** => " . link_to('kuyabiye', '@tag_search', array('query_string' => 'ara=kuyabiye')) . ", kuyabiye etiketine gider.<\/p>\
                                <p>[kelime](kuyabiye) => " . link_to('kelime', '@tag_search', array('query_string' => 'ara=Kuyabiye')) . ", kuyabiye etiketine gider. <\/p>\
                                <h6>Web Adresi Linkleme:<\/h6>\
                                <p>http:\/\/kuyabiye.com => " . link_to('http://kuyabiye.com', '', 'class=out-link') . ", http:\/\/kuyabiye.com adresine gider.<\/p>\
                                <p>[kelime](http:\/\/kuyabiye.com) => " . link_to('kelime', 'http://www.kuyabiye.com') . ", http:\/\/kuyabiye.com adresine gider.<\/p>\
                              <\/div>\
                              <\/div>\
                         <\/form>';
          $('#comment-' + comment_id).after(commentForm);
       }

        $('#comment-form-' + comment_id).slideToggle('fast');
        $('#comment-form-textarea-' + comment_id).focus();
        return false;
      
      });
    
      $('a.toggle-markdown').live('click', function() {
        $(this).parent().next().slideToggle('fast');
        return false;
      });
      
      $('#focus-this').focus();
      
      
      $('textarea[class*=expand]').livequery(function() {
     
        $(this).TextAreaExpander()
     
      });
      
    });");
  
}
?>