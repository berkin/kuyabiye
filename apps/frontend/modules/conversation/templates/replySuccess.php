<?php use_helper('Date') ?>
  
  <div class="message clearfix">
    <?php include_partial('user/avatar', array('user' => $subscriber)); ?>
    <div class="message-content">
    <h3><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname(), 'class=user') ?><span title="<?php echo $message->getCreatedAt() ?>"><?php echo time_ago_in_words($message->getCreatedAt('U')) ?> önce</span></h3>
    <div class="markdown-body">
    <?php echo $message->getHtmlBody() ?>
    </div>
    </div>
  </div>