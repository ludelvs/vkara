      <div>
        <?php echo $html->link('×', 'javascript: void(0);', array('onclick' => 'closePopup();return false', 'class' => 'close')); ?>
      </div>
      <div>
        <dl>
          <dt>タイトル</dt>
          <dd><?php echo $event['title'] ?></dd>
          <dt>開催日</dt>
          <dd>
            <?php echo $event['start_date'][0] ?>年
            <?php echo $event['start_date'][1] ?>月
            <?php echo $event['start_date'][2] ?>日
            (補足: <?php echo $event['start_note'] ?>)
          </dd>
          <dt>開催場所</dt>
          <dd>
            <?php echo $custom->getPrefectureName($event['location_prefecture_id']); ?>
            (補足: <?php echo $event['location_note'] ?>)
          </dd>
          <dt>詳細</dt>
          <dd class="text_area popup"><?php echo $event['body'] ?></dd>
          <dt>募集期限</dt>
          <dd>
            <?php echo $event['deadline_date'][0] ?>年
            <?php echo $event['deadline_date'][1] ?>月
            <?php echo $event['deadline_date'][2] ?>日
          </dd>
        </dl>

      </div>