      <div id="loading_background"></div>
      <div id="loading"></div>
      <div id="event_select">
        <?php echo $html->includeTemplate('event_select.tpl'); ?>
      </div>
      <div class="event_detail"></div>
      <div class="clear"></div>
      <script >
        $(function() {
          $("table#eventCommentTable").tablesorter({ sortList: [[1,0]] });
        });
      </script>

      <?php if ($eventComments->getRaw()): ?>
        <table id="eventCommentTable" class="zebra-striped">
          <thead>
            <tr>
              <th class="yellow header">コメント</th>
              <th class="blue header">コメント投稿日時</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($eventComments as $value): ?>
            <tr>
              <td class="text_area"><?php echo $value['comment']; ?></td>
              <td class="span4"><?php echo $value['register_date']; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>