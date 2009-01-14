<h1>register</h1>
<?php 
  use_helper('Validation');
  echo form_tag('user/register');
?>

  <div class="form-row">
    <?php echo form_error('nickname'); ?>
    <label for="nickname">*nickname:</label>
    <?php echo input_tag('nickname', $sf_params->get('nickname')) ?>
  </div>
  
  <div class="form-row">
    <?php echo form_error('email'); ?>
    <label for="nickname">*email:</label>
    <?php echo input_tag('email', $sf_params->get('email')) ?>
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
    <?php echo input_tag('firstname', $sf_params->get('firstname')) ?>
  </div>

  <div class="form-row">
    <?php echo form_error('lastname'); ?>
    <label for="password">last name:</label>
    <?php echo input_tag('lastname', $sf_params->get('lastname')) ?>
  </div>
  
  <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
  <div class="form-row">
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('register') ?>
  </div>
 
</form>


@todo<br />
  * nickname, do not begin or end with space, do not contain more than 1 space between words. validate class must be external<br />
  * first name and last name do not contain letters, only 1 space between words (this shouldn't be trig error, this should be done in the serverside<br />
  * recaptcha<br />
