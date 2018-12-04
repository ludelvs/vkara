<?php
/**
 * AccountAdd
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: AccountAddAction.class.php 74 2011-12-03 23:54:41Z kouda $
 */
class AccountAddAction extends Mars_Action
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
                                                SystemService::ACCOUNT_CHECK_TYPE_ADD);
    
    if ($isError) {
      $this->form->clear();
      return FALSE;
    }
    
    return TRUE;
  }

  public function execute()
  {
    $manager = $this->managersDAO->formToEntity();
    $manager->setLoginId($this->form->get('loginId'));
    $manager->setLoginPassword(sha1(APP_PRIVATE_KEY . $this->form->get('loginPassword')));

    $managerId = $this->managersDAO->insert($manager);

    $mixiAccount = $this->MixiAccountsDAO->formToEntity();
    $mixiAccount->setManagerId($managerId);
    
    $crypter = new Mars_Crypter();
    $mixiAccount->setPassword($crypter->encrypt($this->form->get('mixiPassword')));
    
    $this->mixiAccountsDAO->insert($mixiAccount);

    $this->messages->add('アカウントを作成しました。');

    return Mars_View::SUCCESS;
  }
}
