<?php use_helper('Validation', 'Object'); ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Hesabım', '@user_edit'); ?>::</li>
  <li><?php echo link_to('Facebook', '@user_edit_facebook'); ?> </li>
</ul>
<div class="content-wrap">
<h1 class="home-header love">Facebook Ayarları</h1>
  <div class="notice">
    <div class="success">
      <?php if ( $sf_flash->has('notice') ) { ?>
        <?php echo $sf_flash->get('notice') ?>
      <?php } else { ?>
      Facebook'da yayınlanması istediğiniz içeriği buradan yönetebilirsiniz.
      <?php } ?>
    </div>      
  </div>  
  <?php 
    use_helper('Validation');
    echo form_tag('@user_edit_facebook');
  ?>
  
    <div class="inputs">
      <?php echo object_checkbox_tag($user, 'getFbPublishStatus') ?>
      <label for="fb_publish_status" class="checkbox">Ne düşünüyorsunuz bölümünü facebook'da da güncelle</label>
      <?php if ( $sf_request->hasError('publish_status') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('publish_status'); ?></div>
      <?php } ?>
    </div>
    <div class="inputs">
      <?php echo object_checkbox_tag($user, 'getFbPublishLove') ?>
      <label for="fb_publish_love" class="checkbox">Sevdiğim ve Sevmediğim etiketleri facebook'da yayınla.</label>
      <?php if ( $sf_request->hasError('publish_love') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('publish_love'); ?></div>
      <?php } ?>
    </div>
    <div class="inputs">
      <?php echo object_checkbox_tag($user, 'getFbPublishComment') ?>
      <label for="fb_publish_comment" class="checkbox">Yaptığım yorumları facebook'da yayınla</label>
      <?php if ( $sf_request->hasError('publish_comment') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('publish_comment'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <br /><br />
      <?php echo submit_image_tag('register-button.gif') ?>
    </div>
   
  </form>
</div>
 
