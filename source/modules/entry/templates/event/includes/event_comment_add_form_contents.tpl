      <div id="loading_background"></div>
      <div id="loading"></div>
      <?php echo $form->start('EventCommentAddConfirm') ?>
        <div id="event_select">
          <?php echo $html->includeTemplate('event_select.tpl'); ?>
        </div>
        <div class="event_detail"></div>
        <div class="clear"></div>
        <div class="chassis">
          <?php echo $form->textArea('comment', 'cols=75; rows=5', array('label' => 'コメント', 'required' => TRUE)) ?>
        </div>
        <p><?php echo $form->inputSubmit('確認', array('class' => 'btn primary')) ?></p>
      <?php echo $form->close() ?>