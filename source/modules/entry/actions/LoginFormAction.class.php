<?php
/**
 * @package modules.manager.actions
 * @author lude <lude@users.sourceforge.jp>
 */

class LoginFormAction extends Mars_Action
{
  public function execute()
  {
    // 既に認証済みであれば Home アクションにフォワード
    if ($this->user->hasRole('entry')) {
      $this->controller->forward('EventList');

      return Mars_View::NONE;
    }

    return Mars_View::SUCCESS;
  }
}
