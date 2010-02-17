<ul class="breadcrumb"><li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li><li><?php echo link_to('Üye Girişi', '@login'); ?> </li></ul>
<div class="content-wrap">
<h1 class="home-header love">Üye Girişi</h1>
  <div class="notice">
    <div class="success">
      <?php echo 'Üye olmak için ' . link_to('buraya', '@register', 'class=bold') . ' tıklayın.' ?>
    </div>      
  </div>   
  <div class="clearfix">
  <?php 
    use_helper('Validation');
    echo form_tag('@login', 'class=ad-sibling');
  ?>

    <div class="inputs">
      <label for="nickname">Rumuz/E-posta:</label>
      <?php echo input_tag('nickname', $sf_params->get('nickname'), array('class' => 'text medium')) ?>
      <div class="form-notice">Rumuzunuz veya e-posta adresinizden herhangi biriyle giriş yapabilirsiniz.</div>
      <?php if ( $sf_request->hasError('nickname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('nickname'); ?></div>
      <?php } ?>
    </div>
   
    <div class="inputs">
      <label for="password">Şifre:</label>
      <?php echo input_password_tag('password', '', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('password') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('password'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="password">&nbsp;</label>
      <?php echo checkbox_tag('remember') ?> Beni Hatırla
    </div>
    <?php echo input_hidden_tag('comment', $sf_request->hasAttribute('comment') ? $sf_request->getAttribute('comment') : $sf_params->get('comment')) ?>
    <?php echo input_hidden_tag('referer', $sf_request->hasAttribute('referer') ? $sf_request->getAttribute('referer') . ( $sf_params->get('link') ? '#' . $sf_params->get('link') : '' ) : $sf_params->get('referer') ) ?>
    <div class="inputs">
      <label for="submit">&nbsp;</label>
      <?php echo submit_image_tag('login-button.gif') ?><?php echo link_to('Şifremi Unuttum', '@user_password_request', array('class' => 'forgot-password-link')) ?>
    </div>

  </form>

   <?php include_partial('tag/ad') ?>
  </div>

</div>