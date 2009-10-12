<ul class="breadcrumb"><li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?></li>::<li><?php echo link_to('Üye Ol', '@register'); ?> </li></ul>
<div class="content-wrap">
<h1 class="home-header love">Üye Ol!</h1>
  <?php 
    use_helper('Validation');
    echo form_tag('user/register');
  ?>

    <div class="inputs">
      <label for="nickname">Kullanıcı Adı*:</label>
      <?php echo input_tag('nickname', $sf_params->get('nickname'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('nickname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('nickname'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="nickname">E-posta Adresi*:</label>
      <?php echo input_tag('email', $sf_params->get('email'), array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('email') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('email'); ?></div>
      <?php } ?>
    </div>  
   
    <div class="inputs">
      <label for="password">Şifre*:</label>
      <?php echo input_password_tag('password', '', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('nickname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('password'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="password">Şifre(Tekrar)*:</label>
      <?php echo input_password_tag('repassword', '', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('repassword') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('repassword'); ?></div>
      <?php } ?>
    </div>
    
  <div class="inputs">
    <label>Cinsiyet:</label>
    <?php echo radiobutton_tag('gender', 0, array( 'id' => 'male')); ?> <label class="radios" for="male">Erkek</label>
    <?php echo radiobutton_tag('gender', 1, array( 'id' => 'female')); ?><label class="radios" for="female">Kadın</label>
    <?php if ( $sf_request->hasError('gender') ) { ?>
    <div class="form-error"><?php echo $sf_request->getError('gender'); ?></div>
    <?php } ?>
    </div>
  
  <div class="inputs">
    <label for="dob">Doğum Tarihi:</label>
    <?php echo input_date_tag('dob', '', array('include_blank' => true, 'culture' => 'tr_TR', 'year_start' => '1920', 'year_end' => date('Y') - 18), '')?>
    <?php if ( $sf_request->hasError('dob') ) { ?>
    <div class="form-error"><?php echo $sf_request->getError('dob'); ?></div>
    <?php } ?>
  </div>
    
    <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
    <div class="inputs">
      <label for="submit">&nbsp;</label>
      <?php echo submit_image_tag('register-button.gif') ?>
    </div>
   
  </form>
</div>


@todo<br />
  * nickname, do not begin or end with space, do not contain more than 1 space between words. validate class must be external<br />
  * first name and last name do not contain letters, only 1 space between words (this shouldn't be trig error, this should be done in the serverside<br />
  * recaptcha<br />
  * üye girişi yapan bu sayfayı göremesin<br />
 
