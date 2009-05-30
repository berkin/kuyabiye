<?php use_helper('Date', 'Javascript'); $i = 0; ?>
<h1><?php echo ( $folder == 0 ) ? 'Gelen Mesajlar' : 'Giden Mesajlar' ?><span><?php echo link_to('yeni mesaj', '@conversation_compose') ?></span></h1>
<div class="tag-actions"><?php echo link_to('Gelen Mesajlar', '@conversations?folder=') . link_to('Giden Mesajlar', '@conversations?folder=sent') ?></div>
<?php echo 'Select: ' . link_to_function('All', "selectMessages('checkbox');") . ' ' . link_to_function('None', "selectMessages('none')") . ' ' . link_to_function('Read', "selectMessages('checkbox-read');") . ' ' . link_to_function('Unread', "selectMessages('checkbox-unread');"); ?>

<?php echo form_tag('@conversation_remove') ?>
  <div class="right">  
  <?php if_javascript(); ?>
    <?php echo submit_to_remote('delete', 'Delete', array(
        'url'      => '@conversation_remove',
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');updateJSON(request, json);",
        '404'       => "alert('oops'); return false;"
    )) ?>

  <?php end_if_javascript(); ?>
  <noscript>
    <?php echo submit_tag('Delete') ?>
  </noscript>
</div>  
  
<br /><br />
<?php foreach ($conversations as $conversation) { $i++; ?>
  <div id="message-<?php echo $conversation->getConversation() ?>" class="conversation<?php echo ( $conversation->getIsRead() ) ? ' read' : ' unread' ?>">
  <b><?php 
  echo $i . '. ' . checkbox_tag('messages[]', $conversation->getConversation(), false, array('class' => 'message-checkbox' . (($conversation->getIsRead()) ? ' checkbox-read' : ' checkbox-unread' ))) . '&nbsp;&nbsp;' . (($conversation->getIsReplied() && $folder == 'inbox') ? image_tag('arrow_rotate_clockwise.png') : '') ;
  if ( $folder == 'inbox' )
  {
    echo link_to($conversation->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedBySender()->getNickname(), array('class' => 'user'));
  }
  else {
    echo link_to($conversation->getUserRelatedByRecipent()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedByRecipent()->getNickname(), array('class' => 'user'));  
  }

    ?></b>

  <?php echo link_to($conversation->getTitle(), '@conversation_read?id=' . $conversation->getConversation()) ?><span style="padding: 0 0 0 10px" class="gray size10"><?php echo time_ago_in_words($conversation->getUpdatedAt('U')) ?> ago</span>
  <?php
  
    echo link_to_remote('(x)', array(
        'url'       => '@conversation_remove?messages[]=' . $conversation->getConversation() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('fade', 'message-' . $conversation->getConversation()),
        '404'       => "alert('oops'); return false;"
        ));
        ?>
</div>
<?php } ?>
</form>
<br /><br /><div id="ney"></div>

@TODO<br />
-getUserRelatedBySender her seferinde user tablosuna bağlantı açıyor<br />
-ajax 404 olmuo<br />
-refactoring, read de isread, reply da isreplied (ayrıca reply yapınca öbür conversation'ın isread ini 0 ve isreplied ini 0  yapmak lazım), compose da 2.satır conversation ve message<br />
-pagination<br />
-send email when new message<br />