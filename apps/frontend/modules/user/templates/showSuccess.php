<?php use_helper('Javascript', 'User') ?>

<h1><?php echo $subscriber->getNickname() ?>
<span id="friend-request-<?php echo $subscriber->getId() ?>">
<?php 
  if ( !$owner ) 
  {
    include_partial('friend_request', array('subscriber' => $subscriber));
  }
?>
</span>
</h1>
<br /> 
<?php echo link_to('Resim yükle', '@user_pictures'); ?><br /><br />
<?php echo link_to('Profil Bilgileri', '@user_edit_profile'); ?><br /><br />
<b><?php echo link_to('show all', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=all') ?></b>

<h2>Son zamanlar sevdikleri</h2>
<ul id="tag_cloud">
<?php foreach ($loved_tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 1 ): ?>
  <li><?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag(), array('class' => 'size-' . $tag->getTag()->getWeight())) ?></li>
<?php endif; endforeach; ?>
</ul>
<b><?php echo link_to('show all', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=love') ?></b>
<br />
<br />
<h2>Son zamanlar Sevmedikleri</h2>
<ul id="tag_cloud">
<?php foreach ($hated_tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 0 ): ?>
  <li><?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag(), array('class' => 'size-' . $tag->getTag()->getWeight())) ?></li>
<?php endif; endforeach; ?>
</ul>
<b><?php echo link_to('show all', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=hate') ?></b>
