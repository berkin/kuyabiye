<?php
// auto-generated by sfPropelCrud
// date: 2009/01/01 18:26:05
?>
<?php use_helper('Javascript'); ?>
      	<div class="tagline">Sevdiğin sevmediğin her şeyi profiline ekle, arkadaşlarınla paylaş!</div>
        
       	<div id="welcome" class="clearfix">
          <div class="tag-flash" id="tag-slideshow">
          <?php foreach ($showcase_tags as $tag): ?>
        	<div class="flash">
            <h2 class="tag"><?php echo link_to($tag, '@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=') ?><small><?php echo link_to($tag->getUser()->getNickname(), '@user_profile?nick=' . $tag->getUser()->getNickname(), array('class' => 'love')) ?> ekledi.</small></h2>
          
            <div class="love-buttons-wrap">
              <ul class="love-buttons">
                <li class="love"><?php echo link_to('Seviyor musun?', '@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=') ?></li>
                <li class="hate"><?php echo link_to('Sevmiyor musun?', '@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=') ?></li>
              </ul>
            </div>
            
            <ul class="tag-list">
            	<li><?php echo $tag->getTotal() ?> kişi profiline eklemiş. <span class="love"><?php echo $tag->getLovers() ?></span> kişi seviyor, <span class="hate"><?php echo $tag->getHaters() ?></span> kişi sevmiyor.</li>
            	<li><?php echo $tag->getNbComments() > 0 ? $tag->getNbComments() . ' yorum yapılmış.' : 'Henüz yorum yapılmamış.' ?></li>
            	<li><?php echo $tag->getLoverGirls() ?> kadın, <?php echo $tag->getLoverBoys() ?> erkek <span class="love">seviyor.</span></li>
            	<li><?php echo $tag->getHaterGirls() ?> kadın, <?php echo $tag->getHaterBoys() ?> erkek <span class="hate">sevmiyor.</span></li>
            </ul>
      	  </div>
          <?php endforeach; ?>
          </div>
          
          <?php include_partial('tag/ad') ?>
   	    </div>
        
        <div id="homepage" class="tags">
        	<h2 class="home-header"><a class="love" href="#">bugünlerde sevilenler</a></h2>
          <div class="tag-cloud tag-love">
            <?php foreach ($loved_tags as $tag): ?>
              <?php echo link_to($tag->getTag(), '@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=', array('class' => 'tag size' . $tag->getWeight())) ?>
            <?php endforeach; ?>
          </div>

          
          <h2 class="home-header"><a class="hate" href="#">bugünlerde sevilmeyenler</a></h2>
          <div class="tag-cloud tag-hate">
            <?php foreach ($hated_tags as $tag): ?>
              <?php echo link_to($tag->getTag(), '@tag?stripped_tag=' . $tag->getStrippedTag(), array('class' => 'tag size' . $tag->getWeight())) ?>
            <?php endforeach; ?>
          </div>
        </div>

        <h2 class="home-header"><a class="love" href="#">yeni üyeler</a></h2>
				<div class="clearfix">        
        <ul class="users clearfix">
          <?php foreach ( $last_users as $user ) { ?>
        	<li><?php include_partial('user/avatar', array( 'user' => $user )) ?></li>
          <?php } ?>
        </ul>
       	</div>
        <?php
        echo javascript_tag("
          $(document).ready(function() {
              $('#tag-slideshow').cycle({
              cleartypeNoBg: true,
              fx: 'scrollVert',
              height: 250,
              width: 600,
              fit: 1,
              delay: 3000
            });
          });
        ");?>   