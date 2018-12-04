<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
  <head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
    <title>イベント作成確認</title>
  </head>
  <body>
    <div class="container">
      <?php echo $html->includeTemplate("../includes/topbar.tpl", 'active=community'); ?>

      <div id="header">
      <div class="page-header">
        <?php echo $html->includeTemplate('../includes/message.tpl'); ?>
        <h1>イベント作成確認</h1>
      </div>    
      </div>
      <div id="contents">
        <div class="confmsg">以下の内容でイベントを一括作成します。</div>
        <?php echo $form->start('EventAdd') ?>
          <div class="chassis">
            <dl>
              <dt>タイトル</dt>
              <dd><?php echo $form->get('title') ?></dd>
              <dt>開催日</dt>
              <dd>
                <?php echo $form->get('start.year') ?>年
                <?php echo $form->get('start.month') ?>月
                <?php echo $form->get('start.day') ?>日
                (補足: <?php echo $form->get('startNote') ?>)
              </dd>
              <dt>開催場所</dt>
              <dd>
                <?php echo $custom->getPrefectureName($form->get('locationPrefectureId')); ?>
                (補足: <?php echo $form->get('locationNote') ?>)              
              </dd>
              <dt>詳細</dt>
              <dd class="text_area"><?php echo $form->get('body') ?></dd>
              
              <dt>募集期限</dt>
              <dd>
                <?php echo $form->get('deadline.year') ?>年
                <?php echo $form->get('deadline.month') ?>月
                <?php echo $form->get('deadline.day') ?>日
              </dd>
              <dt>イベント作成するコミュニティ (コミュニティ数: <?php echo count($mixiCommunityList); ?>)</dt>
              <dd>
                <?php foreach ($mixiCommunityList as $key => $value): ?>
                <div><?php echo $html->link($value['communityName'], 'http://mixi.jp/view_community.pl?id=' . $value['communityId'], array('target' => '_blank')); ?></div>
                <?php endforeach; ?>
              </dd>
              <dt>画像</dt>
              <dd>
                <p><?php echo $html->image(Mars_RewriteRouter::getInstance()->buildRequestPath(array('action' => 'ShowPreviewImage', 'tokenId' => $form->get('tokenId'))), array('class' => 'border', 'alt' => 'photo1')) ?></p>
              </dd>
              
            </dl>
          </div>
          <?php echo $form->inputHidden('decTitle', array('value' => $form->get('title'))); ?>
          <?php echo $form->inputHidden('decBody', array('value' => $form->get('body'))); ?>
          <?php echo $form->requestDataToInputHiddens() ?>
          <p><?php echo $form->inputSubmit('一括作成', array('class' => 'btn primary')) ?></p>
        <?php echo $form->close() ?>
      </div>
      <div id="footer">

      </div>
    </div>
  </body>
</html>
