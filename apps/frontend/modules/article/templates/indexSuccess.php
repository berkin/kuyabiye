<?php use_helper('Date', 'Formatter') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <?php if ( $article->getCategoriesId() != 0 ) { ?>
  <li><?php echo link_to(ucwords($article->getCategory()->getTitle()), '@category?stripped_title=' . $article->getCategory()->getStrippedTitle()); ?>::</li>  
  <?php } ?>
  <li><?php echo link_to($article->getTitle(), '@article?stripped_title=' . $article->getStrippedTitle()); ?></li>
</ul>
<div class="content-wrap">
<h1 class="home-header love"><?php echo $article->getTitle() ?></h1>
<?php echo $article->getBody() ?>
</div>