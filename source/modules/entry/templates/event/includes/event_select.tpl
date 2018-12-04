          <div class="form">
            <?php echo $form->select('eventId', $mixiEventIds, array('onChange' => 'changeEventId(\'' . $custom->getEnvironment('PHP_SELF') . '\');'), array('label' => 'イベントID', 'selected' => $selectedEventId)); ?>
          </div>
          <div class="link">
            <?php echo $html->link(イベント詳細, array(), array('href' => 'javascript: void(0);', 'onclick' => 'popupEventDetail(' . $selectedEventId . ');')) ?>
          </div>