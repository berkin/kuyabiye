<?php 
use_Helper('Javascript');
echo javascript_tag("function toggleMarkdownHelp()
{
  ( document.getElementById('markdown_help').style.display == 'none' ) ? document.getElementById('markdown_help').style.display = 'block' : document.getElementById('markdown_help').style.display = 'none';
}") ?>

<div class="small">
  <?php echo link_to_function('Mesajınızı düzenlemek için bilgiler ', "toggleMarkdownHelp()", 'class=toggle') ?>
</div>
<div class="formatting-help" id="markdown_help" style="display: none">
  <p>**kuyabiye** =><?php echo link_to('kuyabiye', '@tag_search', array('query_string' => 'ara=kuyabiye')) ?>, kuyabiye etiketine gider.</p>
  <p>[kelime](kuyabiye) => <?php echo link_to('kelime', '@tag_search', array('query_string' => 'ara=Kuyabiye')) ?>, kuyabiye etiketine gider. </p>
  <p>http://kuyabiye.com => <?php echo link_to('http://kuyabiye.com', '', 'class=out-link') ?>, http://kuyabiye.com adresine gider.</p>
  <p>[kelime][http://kuyabiye.com] => <?php echo link_to('kelime', 'http://www.kuyabiye.com') ?>, http://kuyabiye.com adresine gider.</p>
</div>