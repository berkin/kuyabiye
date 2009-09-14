<h1>register</h1>
<?php 
  use_helper('Validation', 'Object', 'DateForm', 'Radio');
  echo form_tag('@user_edit_profile');
?>
  <div class="form-row">
    <label for="nickname">nickname:</label>
    <b><?php echo $user->getNickname() ?></b>
  </div>  
  
  <div class="form-row">
    <?php echo form_error('email'); ?>
    <label for="nickname">*email:</label>
    <?php echo object_input_tag($user, 'getEmail') ?>
  </div>  
 
  <div class="form-row">
    <?php echo form_error('password'); ?>
    <label for="password">*password:</label>
    <?php echo input_password_tag('password') ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('repassword'); ?>
    <label for="password">*confirm password:</label>
    <?php echo input_password_tag('repassword') ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('firstname'); ?>
    <label for="password">first name:</label>
    <?php echo object_input_tag($user, 'getFirstname') ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('lastname'); ?>
    <label for="password">last name:</label>
    <?php echo object_input_tag($user, 'getLastname') ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('country'); ?>
    <label for="country">country:</label>
    <?php echo object_select_country_tag($user, 'getCountry',  array('onChange' => 'checkCity(this);')) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('city'); ?>
    <label for="city">city:</label>
    <?php echo select_tag('city', options_for_select($cities, $sf_params->get('city'), array('include_blank' => true))) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('gender'); ?>
    <label>gender:</label>
    <?php echo object_radiobutton_tag($user, 'getGender', 0, array( 'id' => 'male')); ?> <label class="radios" for="male">Male</label>
    <?php echo object_radiobutton_tag($user, 'getGender', 1, array( 'id' => 'female')); ?><label class="radios" for="female">Female</label>
  </div>
  
  <div class="form-row">
    <?php echo form_error('dob'); ?>
    <label for="dob">dob:</label>
    <?php echo object_input_date_tag($user, 'getDob', array('include_blank' => true, 'culture' => 'tr_TR', 'year_start' => '1920', 'year_end' => date('Y') - 18), '')?>
  </div>
 <?php echo object_input_hidden_tag($user, 'getId'); ?>
  <div class="form-row">
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('update') ?>
  </div>
 
</form>


@todo<br />
  - nickname, do not begin or end with space, do not contain more than 1 space between words. validate class must be external<br />
  - first name and last name do not contain letters, only 1 space between words (this shouldn't be trig error, this should be done in the serverside<br />
  - recaptcha<br />
  - city country server side check, compare validatordaki gibi context ile request i alcan, ülke türkiye ise city olacak yoksa olmayacak
  - 