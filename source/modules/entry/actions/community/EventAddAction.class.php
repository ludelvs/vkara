<?php
/**
 * EventAdd
 *
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventAddAction.class.php 90 2011-12-24 22:23:40Z kouda $
 */
class EventAddAction extends Mars_Action
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
    $data['title'] = $form->get('decTitle');
    $data['start'] = $form->get('start');
    $data['startNote'] = $form->get('startNote');
    $data['locationPrefectureId'] = $form->get('locationPrefectureId');
    $data['locationNote'] = $form->get('locationNote');
    $data['body'] = $form->get('decBody');
    $data['deadline'] = $form->get('deadline');
    
    $tokenId = $this->form->get('tokenId');
    $previewPath = $this->systemService->getIconPreviewPath($tokenId);
    $data['photo'] = sprintf('%s/tmp/icons/%s.jpg', APP_ROOT_DIR, build_rand_str());
    move_file($previewPath, $data['photo']);

    $data['mixiCommunityList'] = $this->systemService->getMixiCommunityList();

    $this->systemService->createMixiCommunityEvent($data);
    
    unlink($data['photo']);

    return Mars_View::SUCCESS;
  }
}
