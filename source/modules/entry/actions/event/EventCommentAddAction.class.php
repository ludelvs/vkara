<?php
/**
 * EventCommentAdd
 *
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventCommentAddAction.class.php 91 2011-12-24 22:26:49Z kouda $
 */
class EventCommentAddAction extends Mars_Action
{
  public function validate()
  {
    // 正当なトークンでリクエストされているかチェック
    $tokenState = $this->user->getTokenState(TRUE);

    if ($tokenState == Mars_AuthorityUser::TOKEN_VALID) {
      return TRUE;
    }

    $this->form->clear();
    $this->messages->addError('不正な画面遷移です。');

    return FALSE;
  }

  public function execute()
  {
    $form = $this->form;

    $managerId = $managerId = $this->user->getAttribute('managerId');
    $eventId = $form->get('eventId');
    $data['comment'] = $form->get('decComment');

    $data['mixiCommunityList'] = $this->mixiCommunitiesDAO->findByManagerIdAndEventId($managerId, $eventId);

    $this->systemService->createMixiCommunityComment($data);
    
    
    $eventComment = new EventComments();
    $eventComment->setEventId($eventId);
    $eventComment->setComment($data['comment']);
    $this->eventCommentsDAO->insert($eventComment);
    
    $this->messages->add('コメントを一括投稿しました。');

    return Mars_View::SUCCESS;
  }
}
