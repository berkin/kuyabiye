<?php use_helper('Date', 'Age', 'I18N') ?>
<div class="clearfix" id="profile">
  <div class="user-sidebar">
    <?php echo link_to(image_tag('/'.sfConfig::get('sf_upload_dir_name') . '/users/medium/' . ( $subscriber->getAvatar() ? $subscriber->getAvatar() : '404.gif' ), array('alt' => $subscriber->getNickname(), 'title' => $subscriber->getNickname() . ' - resimler')), '@user_profile?nick=' . $subscriber->getNickname(), array('title' => $subscriber->getNickname(), 'class' => 'user')); ?>    
    <ul class="user-sidebar-actions">
      <li><?php echo link_to('Mesaj Gönder', '@conversation_compose?recipent=' . $subscriber->getNickname()) ?></li>
      <?php if ( !$owner ) { ?>
      <li><div id="friend-request-<?php echo $subscriber->getId() ?>">
          <?php include_partial('friend_request', array('subscriber' => $subscriber)); ?>
          </div>
      </li>
      <?php } ?>
      <li><?php echo link_to('Fotoğraflar (' . $nbPictures . ')', '@user_pictures?nick=' . $subscriber->getNickname()); ?></li>      
      <?php if ( $owner ) { ?>
      <li><?php echo link_to('Fotağraf Yükle', '@user_pictures?nick=' . $subscriber->getNickname()); ?></li>
      <?php } ?>
      <li><?php echo link_to('Etiketleri', '@user_tags?nick=' . $subscriber->getNickname() . '&sense=hepsi&page=') ?></li>
    </ul>
  </div>
  
  <div class="data">
    <h1 class="user-header lucida"><?php echo link_to($subscriber->getNickname(), '@user_profile?nick=' . $subscriber->getNickname()) ?> <?php if ( $subscriber->getQuote() ) { ?><small><?php echo $subscriber->getQuote() ?></small><?php } ?></h1>
    <div class="account lucida <?php echo ($subscriber->getGender() ? 'female' : 'male') ?>">
      <?php $cities = sfConfig::get('app_city'); ?>
      <?php echo ( $subscriber->getDob() ? get_age($subscriber->getDob('U')) . ' yaşında' : '' ); ?><?php echo ( $subscriber->getCountry() && $subscriber->getCountry() != 'TR' ? ', ' . format_country($subscriber->getCountry()) : '' ); ?><?php echo ( $subscriber->getCity() ? ', ' . $cities[$subscriber->getCity()] : '' ); ?>
    </div>
    <div class="tag-counts">
    <span class="love">
      <?php if ( $nbLovedTags && $nbHatedTags ) { ?>
        <?php if ( $nbLovedTags ) { ?>
          <?php echo $nbLovedTags ?></span> etiketi sevdiklerine eklemiş. 
        <?php } else { ?>
        Sevdiklerine henüz birşey eklememiş.
        <?php } ?>
        <?php if ( $nbHatedTags ) { ?>
        <span class="hate"><?php echo $nbHatedTags ?></span> etiketi sevmediklerine eklemiş.
        <?php } else { ?>
        Sevmediklerine henüz birşey eklememiş.
        <?php } ?>
      <?php } else { ?>
        Henüz sevdiklerine veya sevmediklerine birşey eklememiş.
      <?php } ?>
    </div>
    
    <?php if ( !$owner ) { ?>
      <div class="harmony">
        <h3>
          <?php if ( $sf_user->isAuthenticated() ) { ?>
            <?php if ( $harmony < 35 ) { ?>
            İlgi alanlarınızda ortak fazla birşey yok:(
            <?php } elseif ( $harmony < 65 ) { ?>
            İlgi alanlarınızda benzer şeyler var:|
            <?php } else { ?>
            İlgi alanlarınızda ortak birçok şey var:)
            <?php } ?>
          <?php } else { ?>
            İlgi alanlarınız hakkında bilgi yok!
          <?php } ?>
        </h3>
        <div class="harmony-meter"><div class="harmony-fill" style="width: <?php echo $harmony ?>%"><!-- --></div></div>
        <div class="harmony-text">
        
          <?php if ( $tags ) { ?>
            <?php if ( isset($tags['love']) && $tags['love'] ) { ?>
              Sevdikleriniz listenizde 
              <?php 
                $i = 0;
                $loved = array();
                foreach ( $tags['love'] as $tag ) 
                {
                  $loved[] = link_to($tag['tag'], '@tag?stripped_tag=' . $tag['stripped_tag'] . '&page='); 
                  $i++;
                  if ( $i == 3 ) break;
                }
                echo implode(', ', $loved);
              ?> ortak.
            <?php } else { ?>
              Sevdikleriniz listenizde ortak birşey yok. 
            <?php } ?>
            <?php if ( isset($tags['hate']) && $tags['hate'] ) { ?>
            Sevmedikleriniz listenizde               
              <?php 
                $i = 0;
                $hated = array();
                foreach ( $tags['hate'] as $tag ) 
                {
                  $hated[] = link_to($tag['tag'], '@tag?stripped_tag=' . $tag['stripped_tag'] . '&page='); 
                  $i++;
                  if ( $i == 3 ) break;
                }
                echo implode(', ', $hated);
              ?> ortak.
            <?php } else { ?>
            Sevmedikleriniz listenizde ortak birşey yok. 
            <?php } ?>
          <?php } else { ?>
          <?php if ( $sf_user->isAuthenticated() ) { ?>
          Sevdikleriniz ve sevmedikleriniz listenizde hiç ortak birşey!
          <?php } else { ?>
          Ortak ilgi alanlarınızı görmek için <?php echo link_to('üye girişi', '@login', 'class=love'); ?> yapmalısınız. Üye değilseniz, <?php echo link_to('üye olmak', '@register', 'class=love') ?> çok kolay!
          <?php } ?>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
  
  <?php include_partial('tag/ad') ?>

</div>