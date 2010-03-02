<?php use_helper('Javascript', 'User') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to(ucwords($subscriber->getNickname()), '@user_profile?nick=' . $subscriber->getNickname()) ?></li>
</ul>

<?php include_partial('user/user', array('subscriber' => $subscriber, 'nbPictures' => $nbPictures, 'tags' => $common_tags, 'harmony' => $harmony, 'owner' => $owner)) ?>

<div class="tags">
<?php if ( $loved_tags ) { ?>
  <h2 class="home-header"><?php echo link_to('hepsini göster', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevdikleri&page=', array('class' => 'user')) ?><?php echo link_to('son zamanlarda sevdikleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevdikleri&page=', array('class' => 'love')) ?></h2>
  <div class="tag-cloud">
    <?php foreach ($loved_tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 1 ): ?>
      <?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag() . '&page=', array('class' => 'tag size' . $tag->getTag()->getWeight())) ?>
    <?php endif; endforeach; ?>
  </div>
<?php } ?>

<?php if ( $hated_tags ) { ?>  
  <h2 class="home-header"><?php echo link_to('hepsini göster', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevmedikleri&page=', array('class' => 'user')) ?><?php echo link_to('son zamanlarda sevmedikleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=sevmedikleri&page=', array('class' => 'hate')) ?></h2>
  <div class="tag-cloud">
    <?php foreach ($hated_tags as $tag): $question = $tag->getTag(); if ( $tag->getLove() == 0 ): ?>
      <?php echo link_to($question->getTag(), '@tag?stripped_tag=' . $question->getStrippedTag() . '&page=', array('class' => 'tag size' . $tag->getTag()->getWeight())) ?>
    <?php endif; endforeach; ?>
  </div>
<?php } ?>
</div>

