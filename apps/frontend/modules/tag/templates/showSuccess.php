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
<?php
if ( $sf_user->isAuthenticated() ) {
  echo form_tag('@add_comment', 'method=post');
  echo input_hidden_tag('tag', $tag->getID());
  echo input_hidden_tag('token', $token);
}
?>
<div id="comments" class="comments">
<?php foreach ( $comments as $comment ) { ?>
  <?php include_partial('comment/comment', array('comment' => $comment)) ?>
<?php } ?>
</div>

<br /><br />
<h1>yorum ekle</h1>
  <div class="form-row">
    <label for="label">Yorum:</label>
    <?php echo textarea_tag('body0', $sf_params->get('body')) ?>
  </div>
  
  <div class="form-row">
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('send!') ?>
  </div>
<?php if ( $sf_user->isAuthenticated() ) { ?>
</form>  
<?php } ?>
<?php if ( !$sf_user->isAuthenticated() ) { ?>
  <?php echo link_to('yorum eklemek icin giris yapmaniz gerekiyor.', '@login') ?>
<?php } ?>
<hr />
<?php echo link_to('edit', 'tag/edit?id='.$tag->getId()) ?>
&nbsp;<?php echo link_to('list', 'tag/list') ?>
<br />
@TODO<br />
- comment sisteminde transaction veya locktable bi guvenlik lazim<br />
- bu comment save() methoduna bu commentpeer::updateCommentsTree methodunu eklemyi denedin olmadi ama deneyebilirsin yine:P<br \>
- comment pager<br />
- comment'i lib/model/comment.php bunda commentjoinuser methodunu override etmeye �al��m��t�n, �u http://trac.symfony-project.org/wiki/ApplyingCustomJoinsInDoSelect article a bak hydrate filanla startcolumn bunlarla deneyebilirsin.<br />
- reply de login vs. ayr�ca bos gondermeyi engelle
