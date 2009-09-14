<?php
  echo form_tag('@message_add', 'method=post');
  echo input_hidden_tag('conversation', $message->getConversation());
  echo input_hidden_tag('sender', $message->getUserRelatedBySender()->getNickname());

?>
  <div class="form-row">
    <?php echo textarea_tag('body') ?>
  </div>
  
  <div class="form-row">
  <?php if_javascript(); ?>
    <?php echo submit_to_remote('submit', 'send!', array(
        'update'   => 'message-list',
        'url'      => '@message_add',
        'position' => 'bottom'
    )) ?>
  <?php end_if_javascript(); ?>
  <noscript>
    <?php echo submit_tag('send!') ?>
  </noscript>    
  </div>

</form>
<?php include_partial('markdown_help'); ?>