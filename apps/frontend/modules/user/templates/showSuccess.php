<?php use_helper('Javascript', 'User') ?>

<h1><?php echo $subscriber->getNickname() ?>
<span id="friend-request-<?php echo $subscriber->getId() ?>">
<?php include_partial('friend_request', array('subscriber' => $subscriber)) ?>
</span>
</h1>
<br /> 
<h2>Son zamanlar sevdikleri</h2>
<ul id="tag_cloud">
<?php foreach ($tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 1 ): ?>
  <li><?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag()) ?></li>
<?php endif; endforeach; ?>
</ul>
<br />
<h2>Son zamanlar Sevmedikleri</h2>
<ul id="tag_cloud">
<?php foreach ($tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 0 ): ?>
  <li><?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag()) ?></li>
<?php endif; endforeach; ?>
</ul>
