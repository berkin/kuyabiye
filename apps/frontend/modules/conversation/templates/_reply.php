<div class="message no-border clearfix">
  <?php include_partial('user/avatar', array('user' => $sf_user)); ?>
  <div class="message-content">
    <?php
      echo form_tag('@conversation_reply', 'method=post');
      echo input_hidden_tag('conversation', $conversation->getConversation());
      echo input_hidden_tag('reply_to', $conversation->getReplyTo());

    ?>
      <div class="inputs">
        <?php echo textarea_tag('body') ?>
        <?php //include_partial('conversation/markdown_help'); ?>
      </div>
      
      <div class="inputs">
      <?php if_javascript(); ?>
        <?php echo submit_to_remote('submit', '', array(
                'update'   => array( 'success' => 'message-list', 'failure' => ''),
                'url'      => '@conversation_reply',
                'position' => 'bottom',
                'complete' => "document.getElementById('body').value = '';"
              ), array(
                'class' => 'send-button'
              )) ?>
      <?php end_if_javascript(); ?>
      <noscript>
        <?php echo submit_image_tag('send-button') ?>
      </noscript>    
      </div>

    </form>
  </div>
</div>