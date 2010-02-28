<div class="small">
  <?php echo link_to('Mesajınızı düzenlemeniz için gerekli bilgiler', "#", 'class=toggle-markdown') ?>
</div>
<div class="formatting-help" style="display: none">
  <h6 class="first">Etiklet Linkleme:</h6>
  <p>**kuyabiye** =><?php echo link_to('kuyabiye', '@tag_search', array('query_string' => 'ara=kuyabiye')) ?>, kuyabiye etiketine gider.</p>
  <p>[kelime](kuyabiye) => <?php echo link_to('kelime', '@tag_search', array('query_string' => 'ara=Kuyabiye')) ?>, kuyabiye etiketine gider. </p>
  <h6>Web Adresi Linkleme:</h6>
  <p>http://kuyabiye.com => <?php echo link_to('http://kuyabiye.com', '', 'class=out-link') ?>, http://kuyabiye.com adresine gider.</p>
  <p>[kelime](http://kuyabiye.com) => <?php echo link_to('kelime', 'http://www.kuyabiye.com') ?>, http://kuyabiye.com adresine gider.</p>
</div>