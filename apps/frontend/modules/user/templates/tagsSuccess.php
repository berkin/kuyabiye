<?php use_helper('Javascript', 'User', 'Pagination') ?>

<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname()) ?>::</li>
  <li><?php echo link_to($sense, '@user_tags?nick=' . $subscriber->getNickname() . '&sense=' . $sense . '&page=') ?></li>
</ul>

<?php include_partial('user/user', array('subscriber' => $subscriber, 'nbPictures' => $nbPictures, 'owner' => $owner)) ?>

<h2 class="home-header <?php echo $sense == 'sevmedikleri' ? 'hate' : 'love' ?>"><?php
switch ( $sense )
{
  case 'sevdikleri':
    echo 'Sevdikleri (' . $tags->getNbResults() . ')<small>';
    echo link_to('Sevmedikleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevmedikleri&page=') . ', ';
    echo link_to('Hepsi', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=hepsi&page=');
    echo '</small>';
    break;
  case 'sevmedikleri':
    echo 'Sevmedikleri (' . $tags->getNbResults() . ')<small>';;
    echo link_to('Sevdikleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevdikleri&page=') . ', ';
    echo link_to('Hepsi', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=hepsi&page=');
    echo '</small>';
    break;
  default:
    echo 'Hepsi (' . $tags->getNbResults() . ')<small>';
    echo link_to('Sevdikleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevdikleri&page=') . ', ';
    echo link_to('Sevmedikleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevmedikleri&page=');
    echo '</small>';
    break;
}

?></h2>
<div class="tag-cloud">
  <?php foreach ($tags->getResults() as $tag) { ?>
    <?php echo link_to($tag->getTag(), '@tag?stripped_tag=' . $tag->getTag()->getStrippedTag() . '&page=', array('class' => 'tag size' . $tag->getTag()->getWeight())) ?>
  <?php } ?>
</div>
<?php echo pager_navigation($tags, '@user_tags?nick=' . $subscriber->getNickname() . '&sense=' . $sense) ?>