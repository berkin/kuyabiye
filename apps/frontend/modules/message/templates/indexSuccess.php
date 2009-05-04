<?php use_helper('Date'); $i = 0; ?>
<h1>Gelen Mesajlar</h1>

<?php foreach ($messages as $message) { $i++; ?>
  <b><?php echo $i . '. ' . link_to($message->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $message->getUserRelatedByRecipent()->getNickname(), array('class' => 'user')) ?></b>

  <?php echo link_to($message->getTitle(), '@message_read?id=' . $message->getId()) ?><span style="padding: 0 0 0 10px" class="gray size10"><?php echo time_ago_in_words($message->getCreatedAt('U')) ?> ago</span>
<br />
<?php } ?>