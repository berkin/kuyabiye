<?php use_helper('Javascript', 'User') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname()) ?></li>
</ul>

<div class="clearfix" id="profile">
  <?php echo link_to(image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/medium/' . ( $subscriber->getAvatar() ? $subscriber->getAvatar() : '404.gif' ), array('alt' => $subscriber->getNickname(), 'title' => $subscriber->getNickname() . ' - resimler')), '@user_profile?nick=' . $subscriber->getNickname(), array('title' => $subscriber->getNickname(), 'class' => 'user')); ?>
  
  <div class="data">
    <h1 class="main-header"><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname()) ?></h1>
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
      <li><?php echo link_to('Resimler(' . $nbPictures . ')', '@user_pictures?nick=' . $subscriber->getNickname()); ?></li>
      <li><?php echo link_to('Profil Bilgileri', '@user_edit_profile?nick=' . $subscriber->getNickname()); ?></li>
      <li><?php echo link_to('Etiketleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=all') ?></li>
    </ul>
  </div>
  <?php include_partial('tag/ad') ?>
</div>

<div class="tags">
  <h2 class="home-header"><a class="love" href="#">Son zamanlar sevdikleri</a><?php echo link_to('hepsini göster', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=love', array('class' => 'user')) ?></h2>
  <div class="tag-cloud tag-love">
    <?php foreach ($loved_tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 1 ): ?>
      <?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag(), array('class' => 'tag size' . $tag->getTag()->getWeight())) ?>
    <?php endif; endforeach; ?>
  </div>

  
  <h2 class="home-header"><a class="hate" href="#">Son zamanlar Sevmedikleri</a><?php echo link_to('hepsini göster', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=hate', array('class' => 'user')) ?></h2>
  <div class="tag-cloud tag-hate">
    <?php foreach ($hated_tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 0 ): ?>
      <?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag(), array('class' => 'tag size' . $tag->getTag()->getWeight())) ?>
    <?php endif; endforeach; ?>
  </div>
</div>

