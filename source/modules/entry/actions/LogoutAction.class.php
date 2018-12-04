<?php
/**
 * @package modules.manager.actions
 * @author lude <lude@users.sourceforge.jp>
 */

class LogoutAction extends Mars_Action
{
  public function execute()
  {
    $this->user->clear();

    return Mars_View::SUCCESS;
  }
}
