<?php use_helper('Date', 'Javascript'); $i = 0; ?>
<h1><?php echo ( $folder == 0 ) ? 'Gelen Mesajlar' : 'Giden Mesajlar' ?><span><?php echo link_to('yeni mesaj', '@conversation_compose') ?></span></h1>
<div class="tag-actions"><?php echo link_to('Gelen Mesajlar', '@conversations?folder=') . link_to('Giden Mesajlar', '@conversations?folder=sent') ?></div>
<?php echo 'Select: ' . link_to_function('All', "selectMessages('checkbox');") . ' ' . link_to_function('None', "selectMessages('none')") . ' ' . link_to('Read') . ' ' . link_to('Unread'); ?><br /><br />
<?php foreach ($conversations as $conversation) { $i++; ?>
  <b><?php 
  echo $i . '. ' . checkbox_tag('messages[]', $conversation->getId(), false, array('class' => 'message-checkbox'));
  if ( $folder == 'inbox' )
  {
    echo link_to($conversation->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedBySender()->getNickname(), array('class' => 'user'));
  }
  else {
    echo link_to($conversation->getUserRelatedByRecipent()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedByRecipent()->getNickname(), array('class' => 'user'));  
  }

    ?></b>

  <?php echo link_to($conversation->getTitle(), '@conversation_read?id=' . $conversation->getId()) ?><span style="padding: 0 0 0 10px" class="gray size10"><?php echo time_ago_in_words($conversation->getUpdatedAt('U')) ?> ago</span>
<br />
<?php } ?>