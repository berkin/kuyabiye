<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
  <div id="indicator" style="display: none"></div>
  <div id="header">
    <ul>
      <li><?php echo link_to('about', '@homepage') ?></li>
      <?php if ( $sf_user->isAuthenticated() ) { ?>
      <li><?php echo link_to($sf_user->getNickname(), '@user_profile'); ?>'s profile</li>
      <li><?php echo link_to('arkadaşlar', '@friends'); ?></li>
      <li><?php echo link_to('mesajlar', '@messages'); ?></li>
      <li class="last"><?php echo link_to('logout', '@logout'); ?></li>
      <?php } else { ?>
      <li><?php echo link_to('login', '@login') ?></li>
      <li class="last"><?php echo link_to('register', '@register') ?></li>
      <?php } ?>
    </ul>
    <h1><?php echo link_to('kuyabiye', '@homepage') ?></h1>
  </div>
  <div id="search">
    <?php echo form_tag('@tag_search', 'method=post') ?>
    <?php echo input_tag('search') ?>
    <?php echo submit_tag('submit') ?>
    </form>
  </div>
 
  <div id="content">
    <div id="content_main">
      <?php echo $sf_data->getRaw('sf_content') ?>
      <div class="verticalalign"></div>
    </div>
 
    <div id="content_bar">
      <!-- Nothing for the moment -->
      <div class="verticalalign"></div>
    </div>
  </div>
  
</body>
</html>
