Merhaba, <br /><br />

<?php echo htmlspecialchars($fullname) ?>(<?php echo $email2 ?>) size <?php echo link_to('kuyabiye.com', '@homepage', 'absolute=true') ?>'u tavsiye etti. Kuyabiye sevdiğiniz ve sevmediğiniz herşeyi paylaşabileceğiniz bir platform. Sizi bekliyoruz!<br /><br />

<?php if ( $body != '' ) { ?>
  Arkadaşınızın mesajı:<br />
    <?php echo htmlspecialchars($body) ?><br /><br />
<?php } ?>
 
Sevgiley,<br />
kuyabiye.com ^__^