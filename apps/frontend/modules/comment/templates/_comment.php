<?php use_helper('Date', 'I18N', 'Formatter') ?>
<?php
$sense = '';
$lovetext = '';
if ( $comment['love'] == '0' )
{
  $lovetext = 'sevmiyor';
  $sense = 'hater';
}
elseif ( $comment['love'] == '1' )
{
  $lovetext = 'seviyor';
  $sense = 'lover';
}
?>
        <div id="yorum-<?php echo $comment['id'] ?>" class="comment <?php echo $comment['depth'] > 1 ? 'indented' : ''?> clearfix">
        	<?php include_partial('user/avatar', array('user' => $comment)) ?>
          <div class="comment-text <?php echo $sense ?>">

            <p class="<?php echo ( $comment['love'] ? 'love' : 'hate' ) ?> comment-data">  
              <?php 
              echo link_to($comment['nickname'], '@user_profile?nick=' . $comment['nickname'], array('class' => 'user bold')) ?> <?php echo $lovetext ?>. <span title="<?php echo $comment['created_at']; ?>" class="time"><?php echo __(time_ago_in_words(strtotime($comment['created_at']))); ?> önce</span>
            </p>
            <?php if ( $sf_flash->get('comment') == $comment['id'] ) { ?>
              <div class="comment-added">
                <?php echo $sf_flash->get('notice') ?>
              </div>
            <?php } ?>
            
            <div class="markdown-body"><?php echo formatter($comment['body']) ?></div>
            <div id="comment-<?php echo $comment['id'] ?>" class="add-comment clearfix">
              <?php 
              if ( $sf_user->isAuthenticated() ) 
              { 
                echo link_to('yorum yaz', '#', array('id' => 'href-' . $comment['id'], 'class' => 'comment-reply-link'));
              }
              else 
              {
                echo link_to('yorum yaz', '@login', array( 'class' => 'comment-reply-link', 'query_string' => 'link=yorum-' . $comment['id'] ));
              }
              ?>
            </div>
            <?php if ( $sf_flash->get('redirected') == $comment['id'] ) { ?>
              <form action="<?php echo url_for('@add_comment') ?>" method="post" class="comment-reply-form" id="comment-form-<?php echo $comment['id'] ?>">
                              <?php echo input_hidden_tag('tag', $tag) ?>
                              <?php echo input_hidden_tag('comment_id', $comment['id']) ?>
                              <?php echo textarea_tag('body', '', 'class=expand50-500 id=focus-this'); ?>
                              <div class="form-submit clearfix">
                                <div class="submit-button">
                                  <?php echo submit_image_tag('reply-button.gif'); ?>
                                </div> 
                                <?php include_partial('conversation/markdown_help'); ?>
                              </div>                          
              </form>
              <?php } ?>
          </div>
        </div>