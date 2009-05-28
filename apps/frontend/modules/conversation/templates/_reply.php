<?php
  echo form_tag('@conversation_reply', 'method=post');
  echo input_hidden_tag('conversation', $conversation->getId());
  echo input_hidden_tag('reply_to', $conversation->getReplyTo());

?>
  <div class="form-row">
    <?php echo textarea_tag('body') ?>
  </div>
  
  <div class="form-row">
  <?php if_javascript(); ?>
    <?php echo submit_to_remote('submit', 'send!', array(
        'update'   => 'message-list',
        'url'      => '@conversation_reply',
        'position' => 'bottom'
    )) ?>
  <?php end_if_javascript(); ?>
  <noscript>
    <?php echo submit_tag('send!') ?>
  </noscript>    
  </div>

</form>