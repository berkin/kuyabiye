<?php use_helper('Validation'); ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Mesajlar', '@conversations'); ?> </li>
</ul>

<div class="content-wrap">
  <h1 class="home-header love">Yeni Mesaj</h1>
  <?php
    echo form_tag('@conversation_compose', 'method=post');

  ?>
    <div class="inputs">
      <label for="recipent">Kime*:</label>
      <?php echo input_tag('recipent', trim($sf_params->get('recipent')), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('recipent') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('recipent'); ?></div>
      <?php } ?>
    </div>
    <div class="inputs">
      <label for="title">Başlık:</label>
      <?php echo input_tag('title', $sf_params->get('title'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('title') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('title'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="body">Mesaj*:</label>
      <?php echo textarea_tag('body', $sf_params->get('body')) ?>
      <?php if ( $sf_request->hasError('body') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('body'); ?></div>
      <?php } ?>
      <div class="markdown-help">&nbsp;</label><?php include_partial('markdown_help'); ?></div>
    </div>
    
    <div class="inputs">  
      <label for="send">&nbsp;</label>
      <?php echo submit_image_tag('send-button.gif') ?>
    </div>

  </form>
</div>