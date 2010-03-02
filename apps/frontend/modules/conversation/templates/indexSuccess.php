<?php use_helper('Date', 'Javascript', 'Pagination'); $i = 0; ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Mesajlar', '@conversations?page='); ?> </li>
</ul>

<div id="messages" class="content-wrap">
    <h1 class="home-header love"><?php echo ( $folder == 'gelen' ) ? 'Gelen Mesajlar' : 'Giden Mesajlar' ?></h1>
    <ul class="tabs">
      <li class="first"><?php echo link_to('Gelen Mesajlar', '@conversations?page=&folder=') ?></li>
      <li><?php echo link_to('Giden Mesajlar', '@conversations?page=&folder=giden') ?></li>
    </ul>
    
    <?php echo form_tag('@conversation_remove', 'id=remove-form') ?>
    <div class="action clearfix">
      <ul class="right">
        <li class="compose"><?php echo link_to('Yeni Mesaj', '@conversation_compose?recipent=', 'class=love') ?></li>
        <li class="last">      
          <?php if_javascript(); ?>
          <?php echo submit_to_remote('delete', 'Sil', array(
              'url'      => '@conversation_remove',
              'loading'   => "Element.show('indicator');$('remove-form').disable();",
              'complete'  => "Element.hide('indicator');$('remove-form').enable();updateJSON(request, json);",
              '404'       => "return false;"
            ), array(
              'class'   => 'text-submit'
            )) ?>
        <?php end_if_javascript(); ?>
      <noscript>
        <?php echo submit_tag('Delete') ?>
      </noscript></li>
      </ul>
      <ul class="left">
        <li class="first">Seç:</li>
        <li><?php echo link_to_function('Hepsi', "selectMessages('checkbox');") ?></li>
        <li><?php echo link_to_function('Hiçbiri', "selectMessages('none')") ?></li>
        <li><?php echo link_to_function('Okunanlar', "selectMessages('checkbox-read');") ?></li>
        <li class="last"><?php echo link_to_function('Okunmayanlar', "selectMessages('checkbox-unread');") ?></li>
      </ul>
    </div>
    <div class="arrow">&nbsp;</div>
    
    <div class="mailbox">
    <?php foreach ($sf_data->get('conversations')->getResults() as $conversation) { $i++; ?>      
      <div id="message-<?php echo $conversation->getConversation() ?>" class="conversation <?php echo ( $conversation->getIsRead() ) ? 'read' : 'unread' ?>">
          <?php include_partial('user/avatar', array('user' => ( $folder == 'gelen' ? $conversation->getUserRelatedBySender() : $conversation->getUserRelatedByRecipent()))); ?>
          <div class="message-from">
            <small><?php echo time_ago_in_words($conversation->getUpdatedAt('U')) ?> önce</small>
            <?php echo ( $folder == 'gelen' ? link_to($conversation->getUserRelatedBySender()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedBySender()->getNickname()) : link_to($conversation->getUserRelatedByRecipent()->getNickname(), '@user_profile?nick=' . $conversation->getUserRelatedByRecipent()->getNickname()) ) ?>
          </div>
        <div class="message-subject">
          <small>
            <?php     
              echo link_to_remote('(x)', array(
                  'url'       => '@conversation_remove?messages[]=' . $conversation->getConversation() . '&_csrf_token=' . md5(sfConfig::get('app_csrf').session_id()),
                  'loading'   => "Element.show('indicator');",
                  'complete'  => "Element.hide('indicator');" . visual_effect('fade', 'message-' . $conversation->getConversation()),
                  '404'       => "alert('oops'); return false;"
                  ));
            ?>          
          </small> 
          <?php echo checkbox_tag('messages[]', $conversation->getConversation(), false, array('class' => 'message-checkbox' . (($conversation->getIsRead()) ? ' checkbox-read' : ' checkbox-unread' ))) ?>
          <?php echo link_to($conversation->getTitle() ? $conversation->getTitle() : '(başlık yok)', '@conversation_read?id=' . $conversation->getConversation()) ?>
        </div>
      </div>
      
      <?php } ?>

    </div>
    </form>
    <?php if ( !$conversations->getResults() ) { ?>
    <div class="no-message">Mesaj yok!</div>
    <?php } ?>
    <?php echo pager_navigation($conversations, '@conversations?page=&folder=' . $folder) ?>
    </div>
