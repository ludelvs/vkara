<?php
/**
 * CommunityListUpdate
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: CommunityListUpdateAction.class.php 79 2011-12-08 17:41:26Z kouda $
 */
class CommunityListUpdateAction extends Mars_Action
{
  public function execute()
  {
    $mixiCommunityList = $this->systemService->getMixiCommunityList();
    
    $managerId = $this->user->getAttribute('managerId');
    
    $this->mixiCommunitiesDAO->delete($managerId);

    foreach ($mixiCommunityList as $mixiCommunity) {
      $mixiCommunity['managerId'] = $managerId;
      $this->mixiCommunitiesDAO->insert($mixiCommunity);
    }

    return Mars_View::SUCCESS;
  }
}
