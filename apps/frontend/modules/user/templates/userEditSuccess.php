<ul class="breadcrumb"><li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li><li><?php echo link_to('Hesabım', '@user_edit'); ?> </li></ul>
<div class="content-wrap">
<h1 class="home-header love">Hesabım</h1>
<div class="blog-entry">
  <h3 class="sub-header"><?php echo link_to('Üyelik Bilgileri', '@user_edit_profile') ?></h3>
  <?php echo link_to('Şifre, e-posta adresi gibi genel üyelik bilgilerinizi düzenlemek için buraya tıklayın.', '@user_edit_profile') ?>
</div>
<?php if ( $user->getFbIsOn() ) { ?>
<div class="blog-entry">
  <h3 class="sub-header"><?php echo link_to('Facebook Ayarları', '@user_edit_facebook') ?></h3>
  <?php echo link_to('Facebook duvarınızda otomatik yayınlanan içeriği düzenlemek için buraya tıklayın', '@user_edit_profile') ?>
</div>
<?php } else { ?>
<div class="blog-entry">
  <h3 class="sub-header"><?php echo link_to('Facebook\'a bağlan', '@facebook') ?></h3>
  <?php echo link_to('Kuyabiye.com\'da yaptığınız aktivitelerin facebook\'da otomatik olarak paylaşmak için buraya tıklayın.', '@facebook') ?>
</div>
<?php } ?>
<div class="blog-entry">
  <h3 class="sub-header"><?php echo link_to('Resim Yükle', '@user_upload') ?></h3>
  <?php echo link_to('Bu bölümden profil sayfanıza resim yükleyebilirsiniz.', '@facebook') ?>
</div>
</div>