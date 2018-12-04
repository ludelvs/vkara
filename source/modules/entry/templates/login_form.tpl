<?php echo $html->includeTemplate("includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <?php echo $html->includeTemplate("includes/header.tpl"); ?>
  <title>ログイン</title>
</head>
<body>
  <div class="container">
    <?php echo $html->includeTemplate("includes/topbar.tpl", 'active=community'); ?>
      <div class="page-header">
        <?php echo $html->includeTemplate("includes/message.tpl"); ?>
        <h1>ログイン</h1>
      </div>      
    <div id="contents">
      <div class="link_convert_form">
      <?php echo $form->start('Login'); ?>
        <?php echo $html->errors(FALSE); ?>
        <?php echo $form->inputTextAlphabet('loginId', array('size' => 20), array('label' => 'ログイン ID')); ?>
        <?php echo $form->inputPassword('loginPassword', array('size' => 20), array('label' => 'パスワード')); ?>
        <p class="form-button"><?php echo $form->inputSubmit('ログイン', array('class' => 'btn primary')); ?></p>
      <?php echo $form->close(); ?>
      </div>
    </div>
    <div id="footer">
    </div>
  </div>
</body>
</html>
