<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
 
  <div class="wrap">
    
    <div id="header" class="clearfix">
      <ul class="menu">
        <?php if ( $sf_user->isAuthenticated() ) { ?>
        <li><?php echo link_to($sf_user->getNickname(), '@user_profile?nick=' . $sf_user->getNickname()); ?></li>
        <li><?php echo link_to('arkadaşlar' . ( $sf_user->getAttribute('nbFriendRequests') ? '(' . $sf_user->getAttribute('nbFriendRequests') . ')' : ''), '@friends'); ?></li>
        <li><?php echo link_to('mesajlar' . ( $sf_user->getAttribute('nbUnreadMessages') ? '(' . $sf_user->getAttribute('nbUnreadMessages') . ')' : ''), '@conversations?folder=&page='); ?></li>
        <li><?php echo link_to('hesabım', '@user_edit_profile'); ?></li>
        <li class="last"><?php echo link_to('çıkış', '@logout'); ?></li>
        <?php } else { ?>
        <li><?php echo link_to('kuyabiye nedir?', '@homepage') ?></li>
        <li><?php echo link_to('giriş', '@login') ?></li>
        <li class="last"><?php echo link_to('üye ol', '@register') ?></li>
        <?php } ?>
      </ul>
      <!--<div class="advertisement"><img src="images/ad-big.jpg" /></div>-->
      <div class="sub-content">
	      <?php echo link_to(image_tag('kuyabiye-logo.gif', array('alt' => 'kuyabiye logo', 'title' => 'Ana sayfaya dönmek için tıklayın')), '@homepage', array('class' => 'logo', 'title' => 'Sevdiğin sevmediğin herşeyi profiline ekle, arkadaşlarınla paylaş!')) ?>
        <div class="search">
          <?php echo form_tag('@tag_search', 'method=post') ?>
          <?php echo label_for('search', 'Sevdiğin / Sevmediğin her şey') ?>
          <?php echo input_tag('search', $sf_params->get('search'), array('class' => 'search-input')) ?>
          <?php echo submit_image_tag('search-button.gif') ?>
          </form>
        </div>
      </div>
    </div>
      
    <div class="main-wrap">
      <div id="main">
        <div id="content">
          <?php echo $sf_data->getRaw('sf_content') ?>      
        </div>  
      </div>
    </div>
    <div class="push"><!--push--></div>
  </div>
  
  <div id="footer">
  	<div class="footer-wrap">
	  	<div class="left">kuyabiye © 2009</div>
	 		  <ul class="footer-list">
   		 		<li><a href="#">kuyabiye nedir?</a></li>
  		  	<li><a class="break" href="#">arkadaşına gönder</a></li>
 			   	<li><a href="#">blog</a></li>
		    	<li><a href="#">iletişim</a></li>
		    </ul>
    </div>
  </div>
  
</body>
</html>
