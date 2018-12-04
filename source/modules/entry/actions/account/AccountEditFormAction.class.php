<?php
/**
 * AccountEditForm
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: AccountEditFormAction.class.php 42 2011-11-28 09:07:53Z kouda $
 */

class AccountEditFormAction extends Mars_Action
{
  public function execute()
  {
    // トランザクショントークンを発行
    $this->user->saveToken();
    
    $managerId = $this->user->getAttribute('managerId');
    $manager = $this->managersDAO->findByManagerId($managerId);
    $this->renderer->setAttribute('manager', $manager);
    
    $mixiAccount = $this->mixiAccountsDAO->find($managerId);
    $this->renderer->setAttribute('mixiAccount', $mixiAccount);

    return Mars_View::SUCCESS;
  }
}
