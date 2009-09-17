<?php use_helper('User') ?>

<h1>Arkadaşlar</h1>
<div class="tag-actions">
<?php echo link_to('arkadaşlarım', '@friends') ?>
<?php echo link_to('arkadaş istekleri', '@friend_request_list') ?>
</div>
<?php echo $friends->getNbResults() ?> results found.<br />
<?php if ( $friends->getNbResults() ) { ?>
Displaying results <?php echo $friends->getFirstIndice() ?> to  <?php echo $friends->getLastIndice() ?>.
<?php } ?>
<?php
  foreach ( $friends->getResults() as $friend )
  {
    echo '<div class="left">';
    include_partial('user/avatar', array('user' => $friend->getUserRelatedByUserFrom()));
    echo '<br />' . link_to($friend->getUserRelatedByUserFrom()->getNickname(), '@user_profile?nick=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'user'));
?>
<span class="friend-request" id="friend-request-<?php echo $friend->getUserRelatedByUserFrom()->getId() ?>">
<?php include_partial('user/friend_request', array('subscriber' => $friend->getUserRelatedByUserFrom())) ?>
</span>
<?php
    echo '</div>';
  }

?>
<div id="question_pager">
<?php if ($friends->haveToPaginate()): ?>
  <?php echo link_to('&laquo;', '@friends?page=1') ?>
  <?php echo link_to('&lt;', '@friends?page='.$friends->getPreviousPage()) ?>
 
  <?php foreach ($friends->getLinks() as $page): ?>
    <?php echo link_to_unless($page == $friends->getPage(), $page, '@friends?page='.$page) ?>
    <?php echo ($page != $friends->getCurrentMaxLink()) ? '-' : '' ?>
  <?php endforeach; ?>
 
  <?php echo link_to('&gt;', '@friends?page='.$friends->getNextPage()) ?>
  <?php echo link_to('&raquo;', '@friends?page='.$friends->getLastPage()) ?>
<?php endif; ?>
</div>

