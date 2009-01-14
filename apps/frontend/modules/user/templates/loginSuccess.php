<h1>login</h1>
<?php 
  use_helper('Validation');
  echo form_tag('user/login');
?>

  <div class="form-row">
    <?php echo form_error('nickname'); ?>
    <label for="nickname">nickname:</label>
    <?php echo input_tag('nickname', $sf_params->get('nickname')) ?>
  </div>
 
  <div class="form-row">
    <?php echo form_error('password'); ?>
    <label for="password">password:</label>
    <?php echo input_password_tag('password') ?>
  </div>
  
  <div class="form-row">
    <label for="password">&nbsp;</label>
    <?php echo checkbox_tag('remember') ?> remember me
  </div>
  
  <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
  <div class="form-row">
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('sign in') ?>
  </div>
 
</form>

@todo<br />
  * remember me<br />
  * forgot password<br />