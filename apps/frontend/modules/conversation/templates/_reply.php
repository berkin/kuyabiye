<?php
  echo form_tag('@conversation_reply', 'method=post');
  echo input_hidden_tag('conversation', $conversation->getConversation());
  echo input_hidden_tag('reply_to', $conversation->getReplyTo());

?>
  <div class="form-row">
    <?php echo textarea_tag('body') ?>
    <?php include_partial('markdown_help'); ?>
  </div>
  
  <div class="form-row">
  <?php if_javascript(); ?>
    <?php echo submit_to_remote('submit', 'send!', array(
        'update'   => array( 'success' => 'message-list', 'failure' => ''),
        'url'      => '@conversation_reply',
        'position' => 'bottom',
        'complete' => "document.getElementById('body').value = '';"
    )) ?>
  <?php end_if_javascript(); ?>
  <noscript>
    <?php echo submit_tag('send!') ?>
  </noscript>    
  </div>

</form>