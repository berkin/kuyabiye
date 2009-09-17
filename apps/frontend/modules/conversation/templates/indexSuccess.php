<?php use_helper('Date', 'Javascript'); $i = 0; ?>
<h1><?php echo ( $folder == 0 ) ? 'Gelen Mesajlar' : 'Giden Mesajlar' ?><span><?php echo link_to('yeni mesaj', '@conversation_compose') ?></span></h1>
<div class="tag-actions"><?php echo link_to('Gelen Mesajlar', '@conversations?folder=') . link_to('Giden Mesajlar', '@conversations?folder=sent') ?></div>
<?php echo 'Select: ' . link_to_function('All', "selectMessages('checkbox');") . ' ' . link_to_function('None', "selectMessages('none')") . ' ' . link_to_function('Read', "selectMessages('checkbox-read');") . ' ' . link_to_function('Unread', "selectMessages('checkbox-unread');"); ?>

<?php echo form_tag('@conversation_remove') ?>
  <div class="right">  
  <?php if_javascript(); ?>
    <?php echo submit_to_remote('delete', 'Delete', array(
        'url'      => '@conversation_remove',
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');updateJSON(request, json);",
        '404'       => "alert('oops'); return false;"
    )) ?>

  <?php end_if_javascript(); ?>
  <noscript>
    <?php echo submit_tag('Delete') ?>
  </noscript>
</div>  
  
<br /><br />
<?php echo $conversations->getNbResults() ?> results found.<br />
<?php if ( $conversations->getNbResults() ) { ?>
Displaying results <?php echo $conversations->getFirstIndice() ?> to  <?php echo $conversations->getLastIndice() ?>.
<?php } ?>
<?php foreach ($conversations->getResults() as $conversation) { $i++; ?>
  <div id="message-<?php echo $conversation->getConversation() ?>" class="conversation<?php echo ( $conversation->getIsRead() ) ? ' read' : ' unread' ?>">
  <b><?php 
  echo $i . '. ' . checkbox_tag('messages[]', $conversation->getConversation(), false, array('class' => 'message-checkbox' . (($conversation->getIsRead()) ? ' checkbox-read' : ' checkbox-unread' ))) . '&nbsp;&nbsp;' . (($conversation->getIsReplied() && $folder == 'inbox') ? image_tag('arrow_rotate_clockwise.png') : '') ;
  if ( $folder == 'inbox' )
  {
    include_partial('user/avatar', array('user' => $conversation->getUserRelatedBySender()));
    echo link_to($conversation->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedBySender()->getNickname(), array('class' => 'user'));
  }
  else {
    include_partial('user/avatar', array('user' => $conversation->getUserRelatedByRecipent()));
    echo link_to($conversation->getUserRelatedByRecipent()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedByRecipent()->getNickname(), array('class' => 'user'));  
  }

    ?></b>

  <?php echo link_to($conversation->getTitle(), '@conversation_read?id=' . $conversation->getConversation()) ?><span style="padding: 0 0 0 10px" class="gray size10"><?php echo time_ago_in_words($conversation->getUpdatedAt('U')) ?> ago</span>
  <?php
  
    echo link_to_remote('(x)', array(
        'url'       => '@conversation_remove?messages[]=' . $conversation->getConversation() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
        'loading'   => "Element.show('indicator');",
        'complete'  => "Element.hide('indicator');" . visual_effect('fade', 'message-' . $conversation->getConversation()),
        '404'       => "alert('oops'); return false;"
        ));
        ?>
</div>
<?php } ?>
</form>
<?php if ($conversations->haveToPaginate()): ?>
  <?php echo link_to('&laquo;', '@conversations?folder=' . $folder . '&page=' . $conversations->getFirstPage()) ?>
  <?php echo link_to('&lt;', '@conversations?folder=' . $folder . '&page=' . $conversations->getPreviousPage()) ?>
  <?php $links = $conversations->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $conversations->getPage()) ? $page : link_to($page, '@conversations?folder=' . $folder . '&page=' . $page) ?>
    <?php if ($page != $conversations->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to('&gt;', '@conversations?folder=' . $folder . '&page=' . $conversations->getNextPage()) ?>
  <?php echo link_to('&raquo;', '@conversations?folder=' . $folder . '&page=' . $conversations->getLastPage()) ?>
<?php endif ?>
<br /><br /><div id="ney"></div>

@TODO<br />
-message read, add, index gibi kodlar silindi. galba. temizle bunları<br />
-giden mesajlarda çok bağlantı açıo<br />
+getUserRelatedBySender her seferinde user tablosuna bağlantı açıyor ++ aynı tabloyu iki kere join edemiyoz propel ile http://propel.phpdb.org/trac/ticket/157 şu ticketta demişler,  http://stereointeractive.com/blog/2008/01/24/propel-criteria-left-join-using-addjoin-and-addalias-to-join-a-table-twice/ şurda bi denemesi var olmuyor, joinall deyince<br />
+kendi kendine mesaj, şizofren modu engelle<br />
+ajax 404 olmuo, opera da garip davranıyor, firefox da bi tepki veriyor en azından<br />
-refactoring, read de isread, reply da isreplied (ayrıca reply yapınca öbür conversation'ın isread ini 0 ve isreplied ini 0  yapmak lazım), compose da 2.satır conversation ve message<br />
+pagination<br />
+send email when new message<br />
+avatar<br />
-message markdown</br>
-gelen giden mesajlara is_replied ile ilgili bişeyler ekle, doğru çalışmıyor<br />
-isread ilk mesaj attığında ters gibi<br />
-facebook gibi sent kutusu<br />
-save ederken rollback filan<br />
-you have deleted this conversation<br />
-bide mesaj okumaya girdiğinde otomatik aşağı kaysın mı, mesaj sayısı çoksa nolcak, sadece son 5 mesajı filan mı göstersek, gerisini okumak için tıkla filan dese?<br />
-şu mail için veri aktarmayı tek partide yapabilirsin, delicious symfony+email taginde var, array olarak göndercen<br />
-blocked<br />