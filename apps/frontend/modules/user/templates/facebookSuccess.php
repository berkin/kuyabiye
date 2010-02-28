<?php use_helper('Validation', 'Object', 'DateForm', 'Radio', 'Javascript'); ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Hesabım', '@user_edit'); ?>::</li>
  <li><?php echo link_to('Facebook', '@facebook'); ?></li>
</ul>
<div class="content-wrap">
<h1 class="home-header love">Facebook</h1>

<?php if ($sf_flash->has('notice')) { ?>
  <div class="notice">
    <div class="success">
    <?php echo $sf_flash->get('notice') ?>
    </div>
  </div>
<?php } ?>
<div>
  <h2 class="sub-header">Facebook hesabınız var mı?</h2>
  Kuyabiye.com'da yaptığınız aktivitelerin facebook'da otomatik olarak paylaşmak için aşağıdaki facebook'a bağlan butonuna tıklayınız. Açılan pencerede facebook'a üye girişi yapıp, istenilen izinleri onaylayınız. Böylece kuyabiye.com üzerinde yaptığınız aktiviteler otomatik olarak facebook duvarınıza gönderilecek. <br /><br />
</div>
<div id="user">
  <fb:login-button v="2" size="medium" onlogin="update_user_box();">Facebook'a Bağlan</fb:login-button>
</a>
</div>
<div id="grant-permissions" class="permission-box">
  <?php if ( $has_permission_stream && $has_permission_offline ) { ?>
    <?php echo link_to('Facebook izinlerini iptal et!', '@facebook?passive=1', 'class=love') ?>
  <?php } else { ?>
    <fb:prompt-permission perms="offline_access,publish_stream" next_fbjs="update_permission_box();">Kuyabiye'nin facebook ile iletişime geçmesine izin ver.</fb:prompt-permission>  
  <?php } ?>
</div>
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/tr_TR"></script>
<script type="text/javascript">
  function update_user_box() {

    var user_box = document.getElementById("user");

    // add in some XFBML. note that we set useyou=false so it doesn't display "you"
    user_box.innerHTML =
        "<span>"
      + "<fb:profile-pic uid='loggedinuser' facebook-logo='true'></fb:profile-pic>"
      + "Merhaba, <fb:name uid='loggedinuser' useyou='false'></fb:name>."
      + "</span>";

    // because this is XFBML, we need to tell Facebook to re-process the document 
    FB.XFBML.Host.parseDomTree();
    
    FB.Connect.showPermissionDialog("publish_stream, offline_access", function(perms) {
      if (!perms) {
        continue_without_permission();
      } else {
        save_session();
      }
    });
  }
  
  function update_permission_box()
  {
    var permission_box = document.getElementById('grant-permissions');
    
    window.location = '<?php echo url_for('@facebook?save_user=1', 'absolute=true'); ?>';

  }
  
  FB.init("de7b0a87c541206d3af1894764a1e1d8","xd_receiver.htm", {"ifUserConnected" : update_user_box});</script>
</div>
