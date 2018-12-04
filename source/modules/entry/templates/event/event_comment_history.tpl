<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
  <title>コメント履歴</title>
</head>
<body>
  <div class="container">
    <?php echo $html->includeTemplate("../includes/topbar.tpl", 'active=event'); ?>
    <div id="header">
      <div class="page-header">
        <?php echo $html->includeTemplate('../includes/message.tpl'); ?>
        <h1>コメント履歴</h1>
      </div>
    </div>
    <div id="contents">
      <?php echo $html->includeTemplate("includes/event_comment_history_contents.tpl"); ?>
    </div>
    <div id="footer">
    </div>
  </div>
</body>
</html>
