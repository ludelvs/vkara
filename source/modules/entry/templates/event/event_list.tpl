<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
  <title>イベント一覧</title>
</head>
<body>
  <div class="container">    
    <?php echo $html->includeTemplate("../includes/topbar.tpl", 'active=event'); ?>
    <div id="header">
      <div class="page-header">
        <?php echo $html->includeTemplate('../includes/message.tpl'); ?>
        <h1>管理イベント一覧</h1>
      </div>      
      
    </div>
    <div id="contents">
      <div id="loading_background"></div>
      <div id="loading"></div>
      <?php echo $form->start('EventCommentUpdate') ?>
        <div class="upbutton"><?php echo $form->inputSubmit('新着コメント確認', array('class' => 'btn primary')) ?></div>
      <?php echo $form->close() ?>
      <?php echo $form->eventStatusTypeSelect($selectedStatus); ?>
      
      <div class="clear"></div>
      
      <div id="mixiEventList">
        
        <?php echo $html->includeTemplate("includes/mixi_event_list_table.tpl"); ?>
      </div>
      <div class="event_detail"></div>
      
    </div>
  </div>
</body>
</html>
