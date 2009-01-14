<?php use_helper('Date') ?>
<li style="padding-left: <?php echo $comment->getLevel() ?>em;" id="comment-<?php echo $comment->getId() ?>" class="comment">
  <?php echo $comment->getBody() ?><br />
  <span class="gray"><?php echo link_to($comment->getUser()->getNickname(), 'user/profile?nick=' . $comment->getUser()->getNickname()) ?>, <?php echo time_ago_in_words($comment->getCreatedAt('U')) ?> ago</span>
</li>