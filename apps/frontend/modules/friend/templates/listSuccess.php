
<h1>Arkadaşlar</h1>
<div class="tag-actions">
<?php echo link_to('arkadaşlarım', '@friends') ?>
<?php echo link_to('arkadaş istekleri', '@friend_request_list') ?>
<?php echo link_to('blokladıklarım', '@friend_request_list') ?>
</div>
<?php echo $friends->getNbResults() ?> results found.<br />
<?php if ( $friends->getNbResults() ) { ?>
Displaying results <?php echo $friends->getFirstIndice() ?> to  <?php echo $friends->getLastIndice() ?>.
<?php } ?>
<?php
  echo $sf_flash->get('notice');
  foreach ( $friends->getResults() as $friend )
  {
    echo '<div class="left">';
    include_partial('user/avatar', array('user' => $friend->getUserRelatedByUserTo()));
    echo '<br />' . link_to($friend->getUserRelatedByUserTo()->getNickname(), '@user_profile?nick=' . $friend->getUserRelatedByUserTo()->getNickname(), array('class' => 'user'));
    echo link_to('sil?', '@friend_remove?user=' . $friend->getUserRelatedByUserTo()->getNickname());
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
<div style="clear: both">&nbsp;</div>
<br /><br />
@TODO<br />
+ pagination<br />
- sil ajax, are you sure? sorusuyla<br />