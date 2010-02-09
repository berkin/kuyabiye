Merhaba <?php echo $nickname; ?>
Üyelik bilgileriniz:
Kullanıcı adı: <?php echo link_to($nickname, '@user_profile?nick=' . $nickname) ?>
Şifre: <?php echo $password ?>

Profil sayfanıza <?php echo link_to('buraya', '@user_profile?nick=' . $nickname) ?> tıklayarak ulaşabilirsiniz.
 
Sevgiley,
kuyabiye.com ^__^