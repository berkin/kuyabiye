<h1>register</h1>
<?php 
  use_helper('Validation', 'Object', 'DateForm');
  echo form_tag('@user_edit_profile');
?>
  <div class="form-row">
    <label for="nickname">nickname:</label>
    <b><?php echo $user->getNickname() ?></b>
  </div>  
  
  <div class="form-row">
    <?php echo form_error('email'); ?>
    <label for="nickname">*email:</label>
    <?php echo input_tag('email', ( $sf_params->get('email') ) ? $sf_params->get('email') : $user->getEmail()) ?>
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
    <?php echo input_tag('lastname', $user->getLastname()) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('country'); ?>
    <label for="country">country:</label>
    <?php echo select_country_tag('country', null, array('include_blank' => true)) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('city'); ?>
    <label for="city">city:</label>
    <?php echo select_tag('city', options_for_select($cities, null, array('include_blank' => true))) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('gender'); ?>
    <label>gender:</label>
    <?php echo radiobutton_tag('gender', 0, false, array( 'id' => 'male') ) ?><label class="radios" for="male">Male</label>
    <?php echo radiobutton_tag('gender', 1, false, array( 'id' => 'female') ) ?><label class="radios" for="female">Female</label>
  </div>
  
  <div class="form-row">
    <?php echo form_error('dateofbirth'); ?>
    <?php echo input_hidden_tag('dateofbirth'); ?>
    <label for="dob">dob:</label>
    <?php //echo select_date_tag('dob', '', array('include_blank' => true, 'format' => 'dd-MM-yyyy', 'culture' => 'tr_TR', 'year_start' => '1920', 'year_end' => date('Y') - 18));
          echo input_date_tag('dob', '', array('include_blank' => true, 'culture' => 'tr_TR', 'year_start' => '1920', 'year_end' => date('Y') - 18))?>
  </div>
 <?php echo input_hidden_tag('id', $user->getId()); ?>
  <div class="form-row">
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('update') ?>
  </div>
 
</form>


@todo<br />
  * nickname, do not begin or end with space, do not contain more than 1 space between words. validate class must be external<br />
  * first name and last name do not contain letters, only 1 space between words (this shouldn't be trig error, this should be done in the serverside<br />
  * recaptcha<br />
