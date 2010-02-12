<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Arkadaşına Gönder', '@invite_friends'); ?> </li>
</ul>
<div class="content-wrap">
<h1 class="home-header love">Arkadaşına Gönder</h1>
  <div class="notice">
    <?php if ($sf_flash->has('notice')): ?>
      <div class="success"><?php echo $sf_flash->get('notice') ?></div>
    <?php endif; ?>
  </div>  
  <?php 
    use_helper('Validation');
    echo form_tag('@invite_friends');
  ?>
  
    <div class="inputs">
      <label for="fullname">İsminiz*:</label>
      <?php echo input_tag('fullname', $sf_params->get('fullname'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('fullname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('fullname'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="nickname">E-posta Adresiniz*:</label>
      <?php echo input_tag('email2', $sf_params->get('email2'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('email2') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('email'); ?></div>
      <?php } ?>
    </div>  
   
    <div class="inputs">
      <label for="email">Arkadaşınızın<br />&nbsp;&nbsp;e-posta adresi*:</label>
      <?php echo input_tag('email', $sf_params->get('email'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('email') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('email'); ?></div>
      <?php } ?>
    </div>    
    
    <div class="inputs">
      <label for="body">Mesajınız:</label>
      <?php echo textarea_tag('body', $sf_params->get('body')) ?>
      <?php if ( $sf_request->hasError('body') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('body'); ?></div>
      <?php } ?>
    </div>
 
    
    <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
    <div class="inputs">
      <label for="submit">&nbsp;</label>
      <?php echo submit_image_tag('register-button.gif') ?>
    </div>
   
  </form>
</div>
 
