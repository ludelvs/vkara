<?php
/**
 * AccountEdit
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: AccountEditAction.class.php 74 2011-12-03 23:54:41Z kouda $
 */
class AccountEditAction extends Mars_Action
{
  public function validate()
  {
    // 正当なトークンでリクエストされているかチェック
    $tokenState = $this->user->getTokenState(TRUE);

    if ($tokenState != Mars_AuthorityUser::TOKEN_VALID) {
      $this->messages->addError('不正な画面遷移です。', 0);
      $isError = TRUE;
    }
    
    $isError = SystemService::checkAccountExist($this->form->get('loginId'), 
                                                $this->form->get('mixiAccountId'),
                                                SystemService::ACCOUNT_CHECK_TYPE_EDIT);
    
    if ($isError) {
      $this->form->clear();
      return FALSE;
    }
    
    return TRUE;
  }

  public function execute()
  {
    
    $managerId = $this->user->getAttribute('managerId');
    
    $manager['loginId'] = $this->form->get('loginId');
    $manager['managerName'] = $this->form->get('managerName');
    $manager['managerId'] = $managerId;
    
    if ($this->form->get('loginPassword')) {
      $manager['loginPassword'] = sha1(APP_PRIVATE_KEY . $this->form->get('loginPassword'));
    }

    $this->managersDAO->update($manager);

    $account['managerId'] = $managerId;
    $account['mailAddress'] = $this->form->get('mailAddress');
    $account['communityGroupId'] = $this->form->get('communityGroupId');
    
    if ($this->form->get('mixiPassword')) {
      $crypter = new Mars_Crypter();
      $account['mixiPassword'] = $crypter->encrypt($this->form->get('mixiPassword'));
    }
    
    $this->mixiAccountsDAO->update($account);

    $this->messages->add('アカウント情報を更新しました。');

    return Mars_View::SUCCESS;
  }
}
