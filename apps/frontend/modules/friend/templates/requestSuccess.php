<?php use_helper('User', 'Pagination') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Arkadaşlık İstekleri', '@friend_request_list'); ?> </li>
</ul>

<div class="content-wrap clearfix">
  <h1 class="home-header love">Arkadaşlık İstekleri (<?php echo $friends->getNbResults() ?>)</h1>

  <div class="mailbox">
    <?php foreach ( $friends->getResults() as $friend ) { ?>
    <div class="conversation read">
      <?php include_partial('user/avatar', array('user' => $friend->getUserRelatedByUserFrom())); ?>
      <div class="message-from">
        <?php echo link_to($friend->getUserRelatedByUserFrom()->getNickname(), '@user_profile?nick=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'user')); ?>
      </div>
      <div class="message-subject" id="friend-request-<?php echo $friend->getUserRelatedByUserFrom()->getId() ?>">
      <?php include_partial('user/friend_request', array('subscriber' => $friend->getUserRelatedByUserFrom())) ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php echo pager_navigation($friends, '@friend_request_list?page=') ?>
