Merhaba;<br /><br />

<?php echo link_to($nickname, '@user_profile?nick=' . $nickname, 'absolute=true') ?> size mesaj gönderdi. okumak için aşağıdaki adrese tıklayın.<br />
<?php echo url_for('@conversation_read?id=' . $conversation, 'absolute=true') ?><br /><br />

Sevgiley,<br />
kuyabiye.com ^__^