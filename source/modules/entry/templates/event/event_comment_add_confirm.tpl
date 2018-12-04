<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
  <head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
    <title>コメント作成確認</title>
  </head>
  <body>
    <div class="container">
      <?php echo $html->includeTemplate("../includes/topbar.tpl", 'active=event'); ?>

      <div id="header">
      <div class="page-header">
        <?php echo $html->includeTemplate('../includes/message.tpl'); ?>
        <h1>コメント作成確認</h1>
      </div>    
      </div>
      <div id="contents">
        <div class="link">
        </div>        
        <div class="confmsg">以下の内容でコメントを一括投稿します。</div>
        
        <?php echo $form->start('EventCommentAdd') ?>
          <div class="chassis">
            
            <div class="event_detail"></div>
            
            <dl>
              <dt><?php echo $html->link(イベント詳細, array(), array('href' => 'javascript: void(0);', 'onclick' => 'popupEventDetail(' . $form->get('eventId') . ');')) ?></dt>
              <dt>コメント</dt>
              <dd class="text_area"><?php echo $form->get('comment') ?></dd>
              <dt>コメント作成するコミュニティ (コミュニティ数: <?php echo count($mixiCommunityList); ?>)</dt>
              <dd>
                <?php foreach ($mixiCommunityList as $key => $value): ?>
                <div><?php echo $html->link($value['mixi_community_name'], 'http://mixi.jp/view_community.pl?id=' . $value['mixi_community_id'], array('target' => '_blank')); ?></div>
                <?php endforeach; ?>
              </dd>
              
            </dl>
          </div>
          <?php echo $form->inputHidden('decComment', array('value' => $form->get('comment'))); ?>
          <?php echo $form->requestDataToInputHiddens() ?>
          <p><?php echo $form->inputSubmit('一括作成', array('class' => 'btn primary')) ?></p>
        <?php echo $form->close() ?>
      </div>
      <div id="footer">

      </div>
    </div>
  </body>
</html>
