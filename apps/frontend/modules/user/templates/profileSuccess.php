<?php use_helper('Validation', 'Object', 'DateForm', 'Radio', 'Javascript'); ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Hesabım', '@user_edit'); ?>::</li>
  <li><?php echo link_to('Üyelik Bilgileri', '@user_edit_profile'); ?></li>
</ul>
<div class="content-wrap">
<h1 class="home-header love">Üyelik Bilgileri</h1>

<?php if ($sf_flash->has('notice')) { ?>
  <div class="notice">
    <div class="success">
    <?php echo $sf_flash->get('notice') ?>
    </div>
  </div>
<?php } ?>
<?php
  echo form_tag('@user_edit_profile');
?>
    <div class="inputs">
      <label for="nickname">Kullanıcı Adı:</label>
      <span class="text"><?php echo $user->getNickname() ?></span>
    </div>  
    
    <div class="inputs">
      <label for="email">E-posta Adresi*:</label>
      <?php echo object_input_tag($user, 'getEmail', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('email') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('email'); ?></div>
      <?php } ?>
    </div>  
   
    <div class="inputs">
      <label for="password">Şifre*:</label>
      <?php echo input_password_tag('password', '', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('password') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('password'); ?></div>
      <?php } ?>
      </div>
    
    <div class="inputs">
      <label for="repassword">Şifre(Tekrar)*:</label>
      <?php echo input_password_tag('repassword', '', array('class' => 'text medium')) ?>
      <div class="form-notice">Şifrenizi değiştirmek istemiyorsanız şifre alanlarını boş bırakınız.</div>
      <?php if ( $sf_request->hasError('repassword') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('repassword'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="firstname">Adınız:</label>
      <?php echo object_input_tag($user, 'getFirstname', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('firstname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('firstname'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="lastname">Soyadınız:</label>
      <?php echo object_input_tag($user, 'getLastname', array('class' => 'text medium')) ?>
      <?php if ( $sf_request->hasError('lastname') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('lastname'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="country">Ülke:</label>
      <?php echo object_select_country_tag($user, 'getCountry',  array('include_blank' => true, 'onChange' => 'checkCity(this);')) ?>
      <?php if ( $sf_request->hasError('country') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('country'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="city">Şehir:</label>
      <?php echo select_tag('city', options_for_select($cities, ($sf_params->get('city') ? $sf_params->get('city') : $user->getCity() ), array('include_blank' => true )), array('disabled' => ($user->getCountry() != 'TR' ? 'disabled' : ''))) ?>
      <?php if ( $sf_request->hasError('city') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('city'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label>Cinsiyet*:</label>
      <?php echo object_radiobutton_tag($user, 'getGender', 0, array( 'id' => 'male')); ?> <label class="radios" for="male">Erkek</label>
      <?php echo object_radiobutton_tag($user, 'getGender', 1, array( 'id' => 'female')); ?><label class="radios" for="female">Kadın</label>
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
      <?php echo object_input_date_tag($user, 'getDob', array('include_blank' => true, 'culture' => 'tr_TR', 'year_start' => '1920', 'year_end' => date('Y') - 18), '')?>
      <?php if ( $sf_request->hasError('dob') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('dob'); ?></div>
      <?php } ?>
    </div>
    
    <?php echo object_input_hidden_tag($user, 'getId'); ?>
    <div class="inputs">
      <label for="submit">&nbsp;</label>
      <?php echo submit_image_tag('update-button.gif') ?>
    </div>
 
  </form>
</div>
<?php echo javascript_tag("
function checkCity(seld)
{
  var city = document.getElementById('city');
  var country = seld.options[seld.selectedIndex].value;
  
  if ( country != 'TR' )
  {
    city.selectedIndex = 0;
    city.disabled = true;
  }
  else
  {
    city.disabled = false;
  }
}
");
?>