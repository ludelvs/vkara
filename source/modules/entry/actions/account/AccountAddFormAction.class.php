<?php
/**
 * AccountAddForm
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: AccountAddFormAction.class.php 42 2011-11-28 09:07:53Z kouda $
 */

class AccountAddFormAction extends Mars_Action
{
  public function execute()
  {
    // トランザクショントークンを発行
    $this->user->saveToken();
    
    return Mars_View::SUCCESS;
  }
}
