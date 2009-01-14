<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05

use_helper('Date', 'Validation', 'User');
?>
<h1><?php echo $tag->getTag() ?><span>(<?php echo link_to($tag->getUser()->getNickname(), 'user/profile?nick=' . $tag->getUser()->getNickname()) ?> ekledi)</span></h1>
<div class="right gray size10"><?php echo time_ago_in_words($tag->getCreatedAt('U')) ?> ago</div>
<div class="tag-actions" id="love_<?php echo $tag->getId() ?>">
  <?php include_partial('love_buttons', array('tag' => $tag)); ?>
</div>
<br />
<h2>Sevenler / sevmeyenler</h2><br />&nbsp;
<?php
  foreach ( $lovers as $lover )
  {
    echo $lover['nickname'] . ' ' . $lover['love'] . '&nbsp;&nbsp;&nbsp;&nbsp;';
  }
?>
<br />
<br />
<h2>Yorumlar</h2>
<ul id="comments" class="comments">
<?php foreach ( $tag->getTagCommentsJoinUser() as $comment ) { ?>
  <?php include_partial('tagcomment/comment', array('comment' => $comment)) ?>
<?php } ?>
</ul>

<br /><br />
<h1>yorum ekle</h1>
<?php 
if ( $sf_user->isAuthenticated() )
{
  echo form_remote_tag(array(
        'url'       => '@add_comment',
        'update'    => array('success' => 'comments'),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('highlight', 'comments'),
        'position'  => 'top'));

?>
  
  <div class="form-row">
    <label for="label">Yorum:</label>
    <?php echo textarea_tag('body', $sf_params->get('body')) ?>
  </div>
  
  <div class="form-row">
    <?php echo input_hidden_tag('tags_id', $tag->getId()) ?>
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('gonder') ?>
  </div>
</form>  
<?php } ?>
<hr />
<?php echo link_to('edit', 'tag/edit?id='.$tag->getId()) ?>
&nbsp;<?php echo link_to('list', 'tag/list') ?>
