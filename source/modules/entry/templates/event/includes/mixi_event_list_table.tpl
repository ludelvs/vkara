
      <script >
        $(function() {
          $("table#mixiEventListTable").tablesorter({ sortList: [[1,0]] });
        });
      </script>
      <div class="event_count">イベント数： <?php echo count($mixiEvents); ?></div>
      <?php if ($mixiEvents->getRaw()): ?>
        <table id="mixiEventListTable" class="zebra-striped">
          <thead>
            <tr>
              <th class="header center"><?php echo $html->image('image.png', array('width' => '16', 'height' => 16, 'alt' => 'image')); ?></th>
              <th class="red header headerSortDown">コミュニティ名</th>
              <th class="purple header">イベントID</th>
              <th class="green header">コメント数</th>
              <th class="yellow header">新着コメント数</th>
              <th class="blue header">イベント作成日時</th>
              <th class="purple header">コメント最終確認日時</th>
              <th class="orange header">ステータス</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mixiEvents as $value): ?>
            <tr>
              <td class="span2 center"><?php echo $html->image($value['image_url'], array('height' => 32, 'width' => '32')); ?></td>
              <td><?php echo $html->getCommunityLink($value); ?></td>
              <td><?php echo $html->link($value['event_id'], array(), array('href' => 'javascript: void(0);', 'onclick' => 'popupEventDetail(' . $value['event_id'] . ');')) ?></td>
              <td><?php echo $value['latest_comment_id']; ?></td>
              <td id="eventLink<?php echo $value['mixi_event_id']; ?>"><?php echo $html->getEventLink($value); ?></td>
              <td><?php echo $value['register_date']; ?></td>
              <td><?php echo $value['comment_last_check_date']; ?></td>
              <td><?php echo $html->getEventStatusUpdateLink($value); ?><?php echo $html->viewEventDeleteLink($value); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>