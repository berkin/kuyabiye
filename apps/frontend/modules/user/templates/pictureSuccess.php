<?php use_helper('Validation', 'User') ?>

<h1><?php echo $subscriber->getNickname() ?></h1>
<br /> 

<?php  echo form_tag('user/upload', 'multipart=true') ?>
  <div class="form-row">
    <?php echo form_error('picture'); ?>
    <label for="picture">*picture:</label>
    <?php echo input_file_tag('picture', $sf_params->get('picture')) ?>
  </div>
  
  <div class="form-row">
    <label for="submit">&nbsp;</label>
    <?php echo submit_tag('upload') ?>
  </div>

</form>
<br /><br />
<ul>
  <?php foreach ( $pictures as $picture ) { ?>
  <li><?php echo image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/' . $picture->getName()) ?></li>
  <?php } ?>
</ul>

<br /><br />
- avatar resmini işaretle.<br />
- sho sho resmini upload edince upload da takılı kalıyor, resim isminde boşluk olduğundan olabilir, firefoxda deneidm<br />
- kaydedilen resmin ismini değiştir.<br />