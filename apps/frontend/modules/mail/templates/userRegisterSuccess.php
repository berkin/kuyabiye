Merhaba <?php echo $nickname; ?><br /><br />

Üyelik bilgileriniz:<br />
Kullanıcı adı: <?php echo link_to($nickname, '@user_profile?nick=' . $nickname, 'absolute=true') ?><br />
Şifre: <?php echo htmlspecialchars($password) ?><br /><br />

Profil sayfanıza <?php echo link_to('buraya', '@user_profile?nick=' . $nickname, 'absolute=true') ?> tıklayarak ulaşabilirsiniz.<br /><br />
 
Sevgiley,<br />
kuyabiye.com ^__^