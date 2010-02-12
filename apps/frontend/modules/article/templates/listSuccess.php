<?php use_helper('Date', 'Formatter', 'Pagination') ?>
<ul class="breadcrumb"><li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li><li><?php echo link_to('Blog', '@category'); ?> </li></ul>
<div class="content-wrap">
<h1 class="home-header love">Blog</h1>
<?php foreach ( $articles->getResults() as $article ) { ?>
<h2 class="sub-header"><?php echo link_to($article->getTitle(), '@category_articles?stripped_title=' .  $article->getStrippedTitle()) ?></h2>
<div class="blog-entry">
<?php echo $article->getBody() ?>
</div>
<?php } ?>
    <?php echo pager_navigation($articles, '@category') ?>

</div>