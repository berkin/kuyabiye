<ul class="breadcrumb"><li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li><li><?php echo link_to('Şifremi Unuttum', '@user_password_request'); ?> </li></ul>
<div class="content-wrap">
<h1 class="home-header love">Şifremi Unuttum</h1>
  <?php 
    use_helper('Validation');
    echo form_tag('@user_password_request');
  ?>

    <div class="inputs">
      <label for="email">E-posta Adresi:</label>
      <?php echo input_tag('email', $sf_params->get('email'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('email') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('email'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="submit">&nbsp;</label>
      <?php echo submit_image_tag('register-button.gif') ?>
    </div>
   
  </form>
</div>