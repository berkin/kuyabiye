<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05

use_helper('Date', 'Validation', 'User', 'Pagination');
?>
      	<ul class="breadcrumb"><li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li><li><a href="#">Etiketler</a>::</li><li><?php echo link_to($sf_data->get('tag'), '@tag?stripped_tag=' . $tag->getStrippedTag()); ?></li></ul>
        
      <?php include_partial('tag/tag', array('tag' => $sf_data->get('tag'))) ?>
      
<div class="clearfix">
<h2 class="home-header love"><?php
switch ( $sense )
{
  case 'sevenler':
    echo 'Sevenler (' . $users->getNbResults() . ')<small>';
    echo link_to('Sevmeyenler', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevmeyenler&page=') . ', ';
    echo link_to('Hepsi', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=hepsi&page=');
    echo '</small>';
    break;
  case 'sevmeyenler':
    echo 'Sevmeyenler (' . $users->getNbResults() . ')<small>';;
    echo link_to('Sevenler', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevenler&page=') . ', ';
    echo link_to('Hepsi', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=hepsi&page=');
    echo '</small>';
    break;
  default:
    echo 'Hepsi (' . $users->getNbResults() . ')<small>';
    echo link_to('Sevenler', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevenler&page=') . ', ';
    echo link_to('Sevmeyenler', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevmeyenler&page=');
    echo '</small>';
    break;
}

?></h2>
<?php $love = sfConfig::get('app_loves'); ?>
  <ul class="users clearfix">
    <?php foreach ( $users->getResults() as $user ) { ?>
    <li><?php include_partial('user/avatar', array( 'user' => $user->getUser() )) ?><?php echo link_to($user->getUser()->getNickname(), '@user_profile?nick=' . $user->getUser()->getNickname(), 'class=nick') ?></li>
    <?php } ?>
  </ul>
</div>
<?php echo pager_navigation($users, '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=' . $sense); ?>
