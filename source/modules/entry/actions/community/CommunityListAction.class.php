<?php
/**
 * CommunityList
 *
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: CommunityListAction.class.php 42 2011-11-28 09:07:53Z kouda $
 */
class CommunityListAction extends Mars_Action
{
  public function execute()
  {
    $managerId = $this->user->getAttribute('managerId');
    $mixiCommunityList = $this->mixiCommunitiesDAO->findByManagerId($managerId);

    $this->renderer->setAttribute('mixiCommunityList', $mixiCommunityList);

    return Mars_View::SUCCESS;
  }
}
