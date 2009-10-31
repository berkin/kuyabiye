       	<div id="welcome" class="clearfix">
        	<div class="tag-flash">
        		<h1 class="tag"><?php echo link_to($tag, '@tag?stripped_tag=' . $tag->getStrippedTag() . '&page=') ?><small><?php echo link_to($tag->getUser()->getNickname(), '@user_profile?nick=' . $tag->getUser()->getNickname(), array('class' => 'user', 'title' => $tag->getCreatedAt() . ' tarihinde ekledi.')) ?> ekledi.</small></h1>
  
            <div class="love-buttons-wrap" id="love_<?php echo $tag->getId() ?>">
              <?php //include_partial('love_buttons', array('tag' => $tag)); ?>
              <?php include_partial('love_buttons2', array('tag' => $tag)) ?>

            </div>         
            <ul class="tag-list">
            	<li><?php echo link_to($tag->getTotal() . ' kişi', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=hepsi&page=', 'class=love') ?> profiline eklemiş. <span class="love"><?php echo $tag->getLovers() ?></span> kişi seviyor, <span class="hate"><?php echo $tag->getHaters() ?></span> kişi sevmiyor.</li>
            	<li><?php echo $tag->getNbComments() > 0 ? $tag->getNbComments() . ' yorum yapılmış.' : 'Henüz yorum yapılmamış.' ?></li>
            	<li><?php echo $tag->getLoverGirls() ?> kadın, <?php echo $tag->getLoverBoys() ?> erkek <?php echo link_to('seviyor', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevenler&page=', 'class=love') ?>.</li>
            	<li><?php echo $tag->getHaterGirls() ?> kadın, <?php echo $tag->getHaterBoys() ?> erkek <?php echo link_to('sevmiyor', '@tag_lovers?stripped_tag=' . $tag->getStrippedTag() . '&sense=sevmeyenler&page=', 'class=hate') ?>.</li>
            </ul>
      	  </div>
        
          <?php include_partial('tag/ad') ?>
   	    </div>