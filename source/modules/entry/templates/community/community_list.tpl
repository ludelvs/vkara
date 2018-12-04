<?php echo $html->includeTemplate("../includes/header_declaration.tpl"); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <?php echo $html->includeTemplate("../includes/header.tpl"); ?>
  <title>コミュニティ一覧</title>
</head>
<body>
  <div class="container">    
    <?php echo $html->includeTemplate("../includes/topbar.tpl", 'active=community'); ?>
    <div id="header">
      <div class="page-header">
        <h1>管理コミュニティ一覧</h1>
      </div>      
      
    </div>
    <div id="contents">
      <?php echo $form->start('CommunityListUpdate') ?>
        <div class="upbutton"><?php echo $form->inputSubmit('コミュニティ一覧更新', array('class' => 'btn primary')) ?></div>
      <?php echo $form->close() ?>
      <div class="clear"></div>
      <div class="community_count">コミュニティ数： <?php echo count($mixiCommunityList); ?></div>
      <div>
        <script >
          $(function() {
            $("table#mixiCommunityList").tablesorter({ sortList: [[1,0]] });
          });
        </script>
        <table id="mixiCommunityList" class="zebra-striped">
          <thead>
            <tr>
              <th class="blue header center"><?php echo $html->image('image.png', array('width' => '16', 'height' => 16, 'alt' => 'image')); ?></th>
              <th class="blue header headerSortDown">コミュニティ名</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mixiCommunityList as $key => $value): ?>
            <tr>
              <td class="span2 center"><?php echo $html->image($value['image_url'], array('height' => 32, 'width' => '32')); ?></td>
              <td><?php echo $html->getCommunityLink($value); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
