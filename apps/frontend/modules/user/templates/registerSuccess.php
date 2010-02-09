<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Üye Ol', '@register'); ?> </li>
</ul>
<div class="content-wrap">
<h1 class="home-header love">Üye Ol!</h1>
  <?php 
    use_helper('Validation');
    echo form_tag('@register');
  ?>

    <div class="inputs">
      <label for="nickname">Kullanıcı Adı*:</label>
      <?php echo input_tag('nickname', $sf_params->get('nickname'), array('class' => 'text medium')) ?>
      <div class="form-notice">Kullanıcı adında harfler, rakamlar, tire(-) kullanabilirsiniz. Türkçe karakter kullanamazsınız.</div>
      <?php if ( $sf_request->hasError('nickname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('nickname'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="nickname">E-posta Adresi*:</label>
      <?php echo input_tag('email', $sf_params->get('email'), array('class' => 'text medium')) ?>
      <div class="form-notice">E-posta adresiniz 3. şahıslarla paylaşılmaz.</div>
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
      <label for="password">Şifre (Tekrar)*:</label>
      <?php echo input_password_tag('repassword', '', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('repassword') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('repassword'); ?></div>
      <?php } ?>
    </div>
    
  <div class="inputs">
    <label>Cinsiyet*:</label>
    <?php echo radiobutton_tag('gender', 0, $sf_params->get('gender') == 0 ? true : false, array( 'id' => 'male')); ?> <label class="radios" for="male">Erkek</label>
    <?php echo radiobutton_tag('gender', 1, $sf_params->get('gender') == 1 ? true : false, array( 'id' => 'female')); ?><label class="radios" for="female">Kadın</label>
    <?php if ( $sf_request->hasError('gender') ) { ?>
    <div class="form-error"><?php echo $sf_request->getError('gender'); ?></div>
    <?php } ?>
    </div>
  
  <div class="inputs">
    <label for="dob">Doğum Tarihi*:</label>
    <?php 
    $dob = '';
    if ( $sf_params->get('dob') )
    {
      $_dob = $sf_params->get('dob');
      if ( $_dob['day'] != '' && $_dob['month'] != '' && $_dob['year'] )
      {
        $dob = ($_dob['day'] != '' ? $_dob['day'] : '') . '-' . ($_dob['month'] != '' ? $_dob['month'] : '') . '-' . ($_dob['year'] != '' ? $_dob['year'] : '');
      }
    }
    ?>
    <?php echo input_date_tag('dob', $dob, array('include_blank' => true, 'culture' => 'tr_TR', 'year_start' => '1920', 'year_end' => date('Y') - 18), '')?>
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
 
