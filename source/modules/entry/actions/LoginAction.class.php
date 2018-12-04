<?php
/**
 * @package modules.manager.actions
 * @author lude <lude@users.sourceforge.jp>
 */

class LoginAction extends Mars_Action
{
  public function execute()
  {
    $loginId = $this->form->get('loginId');
    $loginPassword = sha1(APP_PRIVATE_KEY . $this->form->get('loginPassword'));

    $manager = $this->managersDAO->find($loginId, $loginPassword);

    if ($manager) {
      $this->user->addRole('entry');
      $this->user->setAttribute('managerId', $manager->getManagerId());
      $this->user->setAttribute('managerName', $manager->getManagerName());
      $this->user->setAttribute('roleType', $manager->getRoleType());

      $this->managersDAO->updateLastLoginDate($manager->getManagerId());
      
      return Mars_View::SUCCESS;
    }

    $this->messages->addError('ログイン認証に失敗しました。');

    return Mars_View::ERROR;
  }
}
