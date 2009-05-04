
<h1>Arkadaşlar</h1>
<div class="tag-actions">
<?php echo link_to('arkadaşlarım', '@friends') ?>
<?php echo link_to('arkadaş istekleri', '@friend_request_list') ?>
<?php echo link_to('blokladıklarım', '@friend_request_list') ?>
</div>
<?php
  foreach ( $friends as $friend )
  {
    echo link_to($friend->getUserRelatedByUserTo()->getNickname(), '@user_profile?nick=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'user'));
    echo link_to('sil?', '@user_profile?task=remove&nick=' . $friend->getUserRelatedByUserTo()->getNickname());
  }