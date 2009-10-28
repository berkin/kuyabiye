<?php use_helper('Pagination') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Arkadaşlar', '@friends'); ?> </li>
</ul>

<div class="content-wrap clearfix">
  <h1 class="home-header love">Arkadaşlar (<?php echo $friends->getNbResults() ?>)</h1>
  
  <div class="notice">
    <?php if ( $sf_user->getAttribute('nbFriendRequests') ) { ?>
      <div class="success">
        <?php echo link_to($sf_user->getAttribute('nbFriendRequests') . ' tane arkadaşlık isteği var. Görmek için tıklayın.', '@friend_request_list'); ?>
      </div>
    <?php } ?>
    <?php if ($sf_flash->has('notice')) { ?>
      <div class="success">
      <?php echo $sf_flash->get('notice') ?>
      </div>
    <?php } ?>
  </div>
  
  <?php if ( $friends->getResults() ) { ?>
  <ul id="gallery" class="users clearfix">

    <?php foreach ( $friends->getResults() as $friend ) { ?>
    <li>
      <?php include_partial('user/avatar', array('user' => $friend->getUserRelatedByUserTo())); ?>
      <span class="action clearfix">
        <?php echo link_to(image_tag('delete.png'), '@friend_remove?user=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'right', 'confirm' => 'Silmek istediğinizden emin misiniz?')); ?>
        <?php echo link_to(image_tag('email.png'), '@conversation_compose?recipent=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'left')) ?>
      </span>
      <div class="nick"><?php echo link_to($friend->getUserRelatedByUserTo()->getNickname(), '@user_profile?nick=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'user')); ?></div>
    <?php } ?>
    </li>
  </ul>
  <?php } else { ?>
    <div class="no-message">Henüz arkadaş eklememişsiniz.</div>
  <?php } ?>
  
</div>
 <?php echo pager_navigation($friends, '@friends?page=') ?>
