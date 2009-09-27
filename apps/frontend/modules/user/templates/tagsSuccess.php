<?php use_helper('Javascript', 'User', 'Pagination') ?>

<h1><?php echo $subscriber->getNickname() ?>
</span>
</h1>
<br /> 

<h2>Son zamanlar sevdikleri</h2>
<ul id="tag_cloud">
<?php foreach ($tags->getResults() as $tag): ?>
  <li><?php echo link_to($tag->getTag(), '@tag?stripped_tag=' . $tag->getTag()->getStrippedTag(), array('class' => 'size-' . $tag->getTag()->getWeight())) ?></li>
<?php endforeach; ?>
</ul>
<?php echo pager_navigation($tags, '@user_tags?nick=' . $subscriber->getNickname() . '&sense=' . $sense) ?>