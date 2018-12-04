<div style="z-index: 5;" class="topbar-wrapper">
    <div data-dropdown="dropdown" class="topbar">
      <div class="topbar-inner">
        <div class="container">
          <h3><?php echo $html->link('Vカラオフ管理', array('action' => 'EventList')); ?></h3>
          <?php if ($user->hasRole('entry')) :?>
          <ul class="nav secondary-nav sysdropdown">
            <li <?php if ($active == 'community'): ?>class="active"<?php endif; ?>><?php echo $html->link('コミュニティ管理', array('action' => 'CommunityList')); ?></li>
            <?php if ($user->get('roleType') <= $custom->isEdit()): ?>            
            <li class="dropdown <?php if ($active == 'community'): ?>active<?php endif; ?>">
              <?php echo $html->link('', '#', array('class' => 'dropdown-toggle')); ?>
              <ul class="dropdown-menu">
                <li><?php echo $html->link('イベント作成', array('action' => 'EventAddForm')); ?></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
          <ul class="nav secondary-nav sysdropdown">
            <li <?php if ($active == 'event'): ?>class="active"<?php endif; ?>><?php echo $html->link('イベント管理', array('action' => 'EventList')); ?></li>
            <?php if ($user->get('roleType') <= $custom->isEdit()): ?>            
            <li class="dropdown <?php if ($active == 'event'): ?>active<?php endif; ?>">
              <?php echo $html->link('', '#', array('class' => 'dropdown-toggle')); ?>
              <ul class="dropdown-menu">
                <li><?php echo $html->link('コメント作成', array('action' => 'EventCommentAddForm')); ?></li>
                <li><?php echo $html->link('コメント履歴', array('action' => 'EventCommentHistory')); ?></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
          <ul class="nav secondary-nav">
            <li <?php if ($active == 'account'): ?>class="active"<?php endif; ?>><?php echo $html->link('アカウント管理', array('action' => 'AccountEditForm')); ?></li>

            <?php if ($user->get('roleType') == $custom->isManage()): ?>
            <li class="dropdown <?php if ($active == 'account'): ?>active<?php endif; ?>">
              <?php echo $html->link('', '#', array('class' => 'dropdown-toggle')); ?>
              <ul class="dropdown-menu">
                <li><?php echo $html->link('アカウント作成', array('action' => 'AccountAddForm')); ?></li>
              </ul>
            </li>
            <?php endif; ?>
            <li><?php echo $html->link('ログアウト', array('action' => 'Logout')); ?></li>
          </ul>
          <?php endif; ?>
        </div>
      </div><!-- /topbar-inner -->
    </div><!-- /topbar -->
  </div>
  <?php if ($user->hasRole('entry')) : ?>
    <div class="account_name"><?php echo $html->image('/common/images/person.png', array('width' => 16, 'height' => 16, 'alt' => 'account')); ?> <span><?php echo $user->get('managerName') ?></span></div>
  <?php endif; ?>