<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05
?>
<h1>tag</h1>

<ul id="tag_cloud">
<?php foreach ($tags as $tag): ?>
    <li><?php echo link_to($tag->getTag(), '@tag?stripped_tag=' . $tag->getStrippedTag()) . $tag->getWeight() ?></li>
<?php endforeach; ?>
</ul>

