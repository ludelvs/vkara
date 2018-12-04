<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
  <head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
    <title>イベント作成</title>
  </head>
  <body>
    <div class="container">
      <?php echo $html->includeTemplate("../includes/topbar.tpl", 'active=community'); ?>

      <div id="header">
      <div class="page-header">
        <?php echo $html->includeTemplate('../includes/message.tpl'); ?>
        <h1>イベント作成</h1>
      </div>    
      </div>
      <div id="contents">
        <?php echo $form->startMultipart('EventAddConfirm') ?>
          <div class="chassis">
            <?php echo $form->inputText('title', array('size' => 30), array('label' => 'タイトル', 'required' => TRUE)) ?>
            <div class="fmst">
              <?php echo $form->selectDate(array('startYear' => '-1', 'endYear' => '+1',  'fieldPrefix' => 'start', 'separator' => array('年', '月', '日')), array(), array('label' => '開催日時', 'required' => TRUE)) ?> 
            </div>
            <div class="fmst codicil">
            <?php echo $form->inputText('startNote', array('size' => 20), array('label' => '補足')) ?>
            </div>
            <div class="clear"></div>
            <div class="fmst">
              <?php echo $form->select('locationPrefectureId', array('values' => $prefectureIds, 'output' => $prefectureNames), NULL, array('selected' => '1', 'label' => '開催場所', 'required' => TRUE)); ?>
            </div>
            <div class="fmst codicil">
              <?php echo $form->inputText('locationNote', array('size' => 20), array('label' => '補足')) ?>
            </div>
            <div class="clear"></div>
            <?php echo $form->textArea('body', 'cols=75; rows=15', array('label' => '詳細', 'required' => TRUE)) ?>
            <?php echo $form->selectDate(array('startYear' => '-1', 'endYear' => '+1', 'fieldPrefix' => 'deadline', 'separator' => array('年', '月', '日')), array(), array('label' => '募集期限', 'required' => TRUE)) ?>
            <?php echo $form->inputFile('photo1', array('size' => 40), array('label' => '画像')) ?>
          </div>
          <p><?php echo $form->inputSubmit('確認', array('class' => 'btn primary')) ?></p>
        <?php echo $form->close() ?>
      </div>
      <div id="footer">

      </div>
    </div>
  </body>
</html>
