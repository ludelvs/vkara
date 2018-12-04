<?php
/**
 * EventCommentAddConfirm
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventCommentAddConfirmAction.class.php 53 2011-11-28 22:39:15Z kouda $
 */
class EventCommentAddConfirmAction extends Mars_Action
{
  public function validate()
  {
    // トークンの状態が正常かチェック
    if ($this->user->getTokenState() != Mars_AuthorityUser::TOKEN_VALID) {
      $this->messages->addError('不正な画面遷移です。');

      return FALSE;
    }
    
    return TRUE;
  }
  
  public function execute()
  {
    $managerId = $managerId = $this->user->getAttribute('managerId');
    $eventId = $this->form->get('eventId');
    $mixiCommunityList = $this->mixiCommunitiesDAO->findByManagerIdAndEventId($managerId, $eventId);
    
    $this->renderer->setAttribute('mixiCommunityList', $mixiCommunityList);
    
    return Mars_View::SUCCESS;
  }
}