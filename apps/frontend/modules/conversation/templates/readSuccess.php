<?php use_helper('Javascript','Date') ?>
<h1>Message Oku</h1>
<div id="message-list">
<b class="m10"><?php echo link_to($conversation->getTitle(), '@conversation_read?id=' . $conversation->getConversation()) ?></b><br />
<span class="m10"><?php echo link_to($conversation->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedBySender()->getNickname()) ?> ve <?php echo link_to($conversation->getUserRelatedByRecipent()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedByRecipent()->getNickname()) ?> arasında</span>
<br /><br />

<?php foreach ($messages as $message) { ?>
  <div class="message">
    <b><?php echo link_to($message->getUser()->getNickname(), '@user_profile?nick=' . $message->getUser()->getNickname(), array('class' => 'user')) ?></b>
    <span class="m10 gray size10"><?php echo time_ago_in_words($message->getCreatedAt('U')) ?> ago</span>
    <p class="page"><?php echo $message->getBody() ?></p>
  </div>
<?php } ?>
</div>
<br /><br />
<div class="page">
<?php include_partial('conversation/reply', array('conversation' => $conversation)) ?>
</div>