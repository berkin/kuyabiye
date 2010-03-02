<?php use_helper('Javascript','Date') ?>
<ul class="breadcrumb">
  <li class="first"><?php echo link_to('Ana Sayfa', '@homepage') ?>::</li>
  <li><?php echo link_to('Mesajlar', '@conversations?page='); ?> </li>
</ul>

<div class="content-wrap">

<h1 class="home-header love">Mesaj</h1>
<?php if ( $conversation->getTitle() ) { ?>
  <h2 class="message-header"><?php echo link_to($sf_data->get('conversation')->getTitle(), '@conversation_read?id=' . $conversation->getConversation()) ?></h2>
<?php } ?>
<div class="clearfix" id="message-list">

  <?php foreach ($messages as $message) { ?>
  <div class="message clearfix">
    <?php include_partial('user/avatar', array('user' => $message->getUser())); ?>
    <div class="message-content">
    <h3><?php echo link_to($message->getUser()->getNickname(), '@user_profile?nick=' . $message->getUser()->getNickname(), 'class=user') ?><span title="<?php echo $message->getCreatedAt() ?>"><?php echo time_ago_in_words($message->getCreatedAt('U')) ?> önce</span></h3>
    <div class="markdown-body">
    <?php echo $message->getHtmlBody() ?>
    </div>
    </div>
  </div>
<?php } ?>

</div>
<?php include_partial('conversation/reply', array('conversation' => $conversation)) ?>


</div>