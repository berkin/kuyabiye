<?php use_helper('Validation'); ?>
<h1>Yeni Mesaj</h1>
<?php
  echo form_tag('@conversation_compose', 'method=post');

?>
  <div class="form-row">
    <?php echo form_error('recipent'); ?>
    <label for="password">recipent:</label>
    <?php echo input_tag('recipent', $sf_params->get('recipent')) ?>
  </div>
  <div class="form-row">
    <?php echo form_error('title'); ?>
    <label for="password">title:</label>
    <?php echo input_tag('title', $sf_params->get('title')) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('body'); ?>
    <label for="password">body:</label>
    <?php echo textarea_tag('body', $sf_params->get('body')) ?>
  </div>
  
  <div class="form-row">  
    <label for="send">&nbsp;</label>
    <?php echo submit_tag('send!') ?>
  </div>

</form>
<?php include_partial('markdown_help'); ?>