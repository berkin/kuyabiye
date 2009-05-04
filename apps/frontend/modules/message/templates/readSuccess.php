<?php use_helper('Javascript','Date') ?>
<h1>Gelen Mesajlar</h1>
<div id="message-list">
<?php foreach ($messages as $message) { ?>
  <b class="m10"><?php echo link_to($message->getTitle(), '@message_read?id=' . $message->getId()) ?></b><br /><br />
  <div class="message">
    <b><?php echo link_to($message->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $message->getUserRelatedByRecipent()->getNickname(), array('class' => 'user')) ?></b>
    <span class="m10 gray size10"><?php echo time_ago_in_words($message->getCreatedAt('U')) ?> ago</span>
    <p class="page"><?php echo $message->getBody() ?></p>
  </div>
<?php } ?>
</div>
<br /><br />
<div class="page">
<?php include_partial('message/new_message', array('message' => $message)) ?>
</div>