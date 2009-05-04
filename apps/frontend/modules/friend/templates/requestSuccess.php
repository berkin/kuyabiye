<?php use_helper('User') ?>

<h1>Arkadaşlar</h1>
<div class="tag-actions">
<?php echo link_to('arkadaşlarım', '@friends') ?>
<?php echo link_to('arkadaş istekleri', '@friend_request_list') ?>
<?php echo link_to('blokladıklarım', '@friend_request_list') ?>
</div>
<?php
  foreach ( $friends as $friend )
  {
    echo link_to($friend->getUserRelatedByUserFrom()->getNickname(), '@user_profile?nick=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'user'));
?>
<span class="friend-request" id="friend-request-<?php echo $friend->getUserRelatedByUserFrom()->getId() ?>">
<?php include_partial('user/friend_request', array('subscriber' => $friend->getUserRelatedByUserFrom())) ?>
</span>
<?php
  }

?>