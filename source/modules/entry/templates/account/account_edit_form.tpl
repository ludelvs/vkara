<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
  <head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
    <title>アカウント管理</title>
  </head>
  <body>
    <div class="container">
      <?php echo $html->includeTemplate('../includes/topbar.tpl', 'active=account'); ?>

      <div id="header">
      <div class="page-header">
        <?php echo $html->includeTemplate('../includes/message.tpl'); ?>
        <h1>アカウント編集</h1>
      </div>    
      </div>
      <div id="contents">
        <?php echo $form->start('AccountEdit') ?>
          <div class="chassis">
            <?php echo $form->inputTextAlphabet('loginId', array('size' => 30, 'value' => $manager->getLoginId()), array('label' => 'ログインID', 'required' => TRUE)) ?>
            <?php echo $form->inputText('managerName', array('size' => 30, 'value' => $manager->getManagerName()), array('label' => 'アカウント名', 'required' => TRUE)) ?>
            <?php echo $form->inputPassword('loginPassword', array('size' => 10, 'value' => ''), array('label' => 'ログインパスワード (英数字 4～8 文字)')) ?>
            <?php echo $form->inputPassword('loginPasswordVerify', array('size' => 10, 'value' => ''), array('label' => 'ログインパスワード (確認)')) ?>
          </div>
          <div class="chassis">
            <?php echo $form->inputTextNumeric('mixiAccountId', array('size' => 10, 'value' => $mixiAccount->getMixiAccountId()), array('label' => 'mixiID', 'required' => TRUE)) ?>            
            <?php echo $form->inputTextAlphabet('mailAddress', array('size' => 30, 'value' => $mixiAccount->getMailAddress()), array('label' => 'mixiメールアドレス', 'required' => TRUE)) ?>
            <?php echo $form->inputPassword('mixiPassword', array('size' => 12, 'value' => ''), array('label' => 'mixiパスワード')) ?>
            <?php echo $form->inputPassword('mixiPasswordVerify', array('size' => 12, 'value' => ''), array('label' => 'mixiパスワード (確認)')) ?>
            <?php echo $form->inputTextNumeric('communityGroupId', array('size' => 2, 'value' => $mixiAccount->getCommunityGroupId()), array('label' => 'コミュニティグループID', 'required' => TRUE)); ?>
          </div>
          <p><?php echo $form->inputSubmit('更新', array('class' => 'btn primary')) ?></p>
        <?php echo $form->close() ?>
      </div>
      <div id="footer">

      </div>
    </div>
  </body>
</html>
