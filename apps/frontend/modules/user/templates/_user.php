<?php use_helper('Date', 'Age', 'I18N') ?>
<div class="clearfix" id="profile">
  <?php echo link_to(image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/medium/' . ( $subscriber->getAvatar() ? $subscriber->getAvatar() : '404.gif' ), array('alt' => $subscriber->getNickname(), 'title' => $subscriber->getNickname() . ' - resimler')), '@user_profile?nick=' . $subscriber->getNickname(), array('title' => $subscriber->getNickname(), 'class' => 'user')); ?>
  
  <div class="data">
    <h1 class="main-header"><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname()) ?></h1>
    <div class="account">
      <?php $cities = sfConfig::get('app_city'); ?>
      <?php echo ( $subscriber->getDob() ? get_age($subscriber->getDob('U')) . ' yaşında' : '' ); ?><?php echo ( $subscriber->getCountry() ? ', ' . format_country($subscriber->getCountry()) : '' ); ?><?php echo ( $subscriber->getCity() ? ', ' . $cities[$subscriber->getCity()] : '' ); ?>
    </div>
    <ul class="buttons">
      <li><span id="friend-request-<?php echo $subscriber->getId() ?>">
          <?php 
            if ( !$owner ) 
            {
              include_partial('friend_request', array('subscriber' => $subscriber));
            }
          ?>
          </span>
      </li>
      <li class="email-icon"><?php echo link_to('Mesaj Gönder', '@conversation_compose?recipent=' . $subscriber->getNickname()) ?></li>
      <li class="picture-icon"><?php echo link_to('Fotoğraflar (' . $nbPictures . ')', '@user_pictures?nick=' . $subscriber->getNickname()); ?></li>      
      <?php if ( $owner ) { ?>
      <li class="picture-icon"><?php echo link_to('Fotağraf Yükle', '@user_pictures?nick=' . $subscriber->getNickname()); ?></li>
      <?php } ?>
      <li class="tag-icon"><?php echo link_to('Etiketleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=hepsi&page=') ?></li>
    </ul>
  </div>
</div>