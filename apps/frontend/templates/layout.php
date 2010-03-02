<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo isset($facebook) ? $facebook : '' ?> xml:lang="tr" lang="tr">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

</head>
<body>
  <div style="display: none;" id="indicator"><!-- indicator--></div>
  <div class="wrap">
    
    <div id="header" class="clearfix">
      <ul class="menu">
        <?php if ( $sf_user->isAuthenticated() ) { ?>
        <li><?php echo link_to($sf_user->getNickname(), '@user_profile?nick=' . $sf_user->getNickname()); ?></li>
        <li><?php echo link_to('arkadaşlar' . ( $sf_user->getAttribute('nbFriendRequests') ? '(' . $sf_user->getAttribute('nbFriendRequests') . ')' : ''), '@friends'); ?></li>
        <li><?php echo link_to('mesajlar ' . ( $sf_user->getAttribute('nbUnreadMessages') ? '(' . $sf_user->getAttribute('nbUnreadMessages') . ')' : ''), '@conversations?folder=&page='); ?></li>
        <li><?php echo link_to('hesabım', '@user_edit'); ?></li>
        <li class="last"><?php echo link_to('çıkış', '@logout'); ?></li>
        <?php } else { ?>
        <li><?php echo link_to('kuyabiye nedir?', '@article?stripped_title=kuyabiye-nedir') ?></li>
        <li><?php echo link_to('giriş', '@login') ?></li>
        <li class="last"><?php echo link_to('üye ol', '@register') ?></li>
        <?php } ?>
      </ul>
      <!--<div class="advertisement"><img src="images/ad-big.jpg" /></div>-->
      <div class="sub-content">
	      <?php echo link_to(image_tag('kuyabiye-logo.gif', array('alt' => 'kuyabiye logo', 'title' => 'Ana sayfaya dönmek için tıklayın')), '@homepage', array('class' => 'logo', 'title' => 'Sevdiğin sevmediğin herşeyi profiline ekle, arkadaşlarınla paylaş!')) ?>
        <div class="search">
          <?php echo form_tag('etiket/ara', array('method' => 'get', 'onsubmit' => 'this.submit();return false;')) ?>
          <?php //echo form_tag('etiket/ara', array('method' => 'get', 'onsubmit' => 'document.location.href = \'' . url_for('@tag_search') . '?ara=\' + escape(this.ara.value);return false')) ?>
          <?php echo label_for('ara', 'Sevdiğin / Sevmediğin Herşey') ?>
          <?php echo input_tag('ara', $sf_params->get('ara'), array('class' => 'search-input')) ?>
          <?php echo submit_image_tag('search-button.gif', 'alt=Etiket Ara') ?>
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
	  	<div class="left">kuyabiye © <?php echo date('Y') ?></div>
	 		  <ul class="footer-list">
   		 		<li><?php echo link_to('kuyabiye nedir?', '@article?stripped_title=kuyabiye-nedir') ?></li>
  		  	<li><?php echo link_to('arkadaşına gönder', '@invite_friends', 'class=break') ?></li>
 			   	<li><?php echo link_to('blog', '@category') ?></li>
		    	<li><?php echo link_to('iletişim', '@contact') ?></li>
		    </ul>
    </div>
  </div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-262439-12");
pageTracker._trackPageview();
} catch(err) {}</script>  
</body>
</html>
