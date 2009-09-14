<?php use_helper('Date') ?>
  <div class="message">
    <b><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname(), array('class' => 'user')) ?></b>
    <span class="m10 gray size10"><?php echo time_ago_in_words($message->getCreatedAt('U')) ?> ago</span>
    <p class="page"><?php echo $message->getHtmlBody() ?></p>
  </div>