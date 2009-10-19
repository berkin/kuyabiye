<?php use_helper('Validation', 'User') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname()) ?>::</li>
  <li><?php echo link_to('Resimler', '@user_pictures?nick=' . $subscriber->getNickname()); ?></li>
</ul>

<div class="content-wrap">

  <?php if ( $owner ) { ?>
  <h4 class="main-header love">Resim Yükle</h1>  
  <?php  echo form_tag('@user_upload', array('multipart' => true, 'id' => 'upload-form')) ?>
  
    <div class="inputs">
      <label for="picture">*Resim:</label>
      <?php echo input_file_tag('picture', $sf_params->get('picture')) ?>
      <?php if ( $sf_request->hasError('picture') ) { ?>
      <div class="form-error"><?php echo $sf_request->getError('picture'); ?></div>
      <?php } ?>
    </div>
    
    <div class="inputs">
      <label for="submit">&nbsp;</label>
      <?php echo submit_image_tag('upload-button.gif') ?>
    </div>
  
  </form>
  <?php } ?>
  
  <?php $nbPictures = count($pictures); ?>
  <?php if ( $nbPictures ) { ?>
  <h1 class="main-header love">Resimler</h1>
  <div class="clearfix">  
    <?php if ( $owner ) { ?>
        <div class="notice">
          <div class="general">Resimlerinizi silmek için <?php echo image_tag('delete.png') ?> ikonuna tıklayın. Resminizi avatar yapmak için <?php echo image_tag('vcard.png') ?> ikonuna tıklayın. En fazla 20 adet resim yükleyebilirsiniz.</div>
        <?php if ($sf_flash->has('notice')) { ?>
          <div class="success">
          <?php echo $sf_flash->get('notice') ?>
          </div>
        <?php } ?>
        </div>
    <?php } ?>
    <ul id="gallery" class="users clearfix">
      <?php foreach ( $pictures as $picture ) { ?>
      <li <?php echo $picture->getName() == $subscriber->getAvatar() ? 'class="avatar"' : '' ?>>
        <a class="lightbox" title="<?php echo $subscriber->getNickname() ?> resimleri" href="<?php echo image_path('/'. sfConfig::get('sf_upload_dir_name') . '/users/large/' . $picture->getName()) ?>"><?php echo image_tag('/' . sfConfig::get('sf_upload_dir_name') . '/users/' . $picture->getName())?></a>
        <?php if ( $owner ) { ?>
        <span class="action clearfix">
          <?php echo link_to(image_tag('delete.png'), '@user_picture_delete?id=' . $picture->getId(), array('class' => 'right', 'confirm' => 'Silmek istediğinizden emin misiniz?')) ?>
          <?php echo link_to(image_tag('vcard.png'), '@user_picture_avatar?id=' . $picture->getId(), array('class' => 'left')) ?>
        </span>
        <?php } ?>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
</div>
<?php
echo javascript_tag("
  $(function() {
    $('#gallery a.lightbox').lightBox({
      fixedNavigation: true,
      imageLoading: '" . image_path('/' . sfConfig::get('sf_upload_dir_name') . '/loading.gif') . "',
      imageBtnClose: '" . image_path('/' . sfConfig::get('sf_upload_dir_name') . '/close.gif') . "',
      imageBtnPrev: '" . image_path('/' . sfConfig::get('sf_upload_dir_name') . '/prev.gif') . "',
      imageBtnNext: '" . image_path('/' . sfConfig::get('sf_upload_dir_name') . '/next.gif') . "',
      imageBlank: '" . image_path('/' . sfConfig::get('sf_upload_dir_name') . '/blank.gif') . "',
      txtImage:  'Resim',
      txtOf: '/'
    });
  });
");?> 