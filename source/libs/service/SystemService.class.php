<?php
/**
 * SystemService
 *
 * @auther lude <lude@users.sourceforge.jp>
 * @version $Id: SystemService.class.php 98 2012-02-15 14:50:46Z kouda $
 */

class SystemService extends Mars_DIComponent
{
  const ACCOUNT_CHECK_TYPE_ADD = 1;
  const ACCOUNT_CHECK_TYPE_EDIT = 2;

  /**
   * getMixiCommunityList
   *
   * @param object $sender
   * @return object $sender
   * @author lude <lude@users.sourceforge.jp>
   */
  public function getMixiCommunityList()
  {
    $response = Mars_DIContainerFactory::getContainer()->getResponse();

    $sender = $this->setMixiLoginSender();

    $managerId = $this->user->getAttribute('managerId');
    $account = $this->mixiAccountsDAO->find($managerId);

    $sender->setRequestMethod(Mars_HttpRequest::HTTP_GET);
    $sender->setRequestPath('/list_community.pl');
    $sender->addParameter('tag_id', $account->getCommunityGroupId());
    $parser = $sender->send();

    $contents = $parser->getContents();
    $contents = mb_convert_encoding($contents, 'UTF-8', 'EUC');

    $pattern = '/view_community.pl\?id=(.*)"\ style.*url\((http:.*)\).*title="(.*)"/';
    if (!preg_match_all($pattern, $contents, $matches)) {
      $response->setStatus(400);
      throw new Mars_RequestException('Contents type is illegal.');
    }

    foreach ($matches[1] as $key => $value) {
      $mixiCommunityList[$key]['communityId'] = $value;
      $mixiCommunityList[$key]['communityName'] = $matches[3][$key];
      $mixiCommunityList[$key]['imageUrl'] = $matches[2][$key];
    }

    return $mixiCommunityList;
  }

  /**
   * createMixiCommunityEvent
   *
   * @param array $data
   * @return object $sender
   * @author lude <lude@users.sourceforge.jp>
   */
  public function createMixiCommunityEvent($data)
  {

    $response = Mars_DIContainerFactory::getContainer()->getResponse();

    $eventId = $this->eventsDAO->insert($data);

    $baseSender = $this->setMixiLoginSender();

    foreach ($data['mixiCommunityList'] as $community) {

      $sender = $baseSender;
      // view_bbs.pl
      $sender->setRequestMethod(Mars_HttpRequest::HTTP_POST);
      $sender->setRequestPath('/add_event.pl');
      $sender->addParameter('id', $community['communityId']);
      $sender->setFollowLocation(FALSE);
      $sender->addParameter('submit', 'main');
      $sender->addParameter('title', mb_convert_encoding($data['title'], 'EUC', 'UTF-8'));
      $sender->addParameter('start_year', $data['start']['year']);
      $sender->addParameter('start_month', $data['start']['month']);
      $sender->addParameter('start_day', $data['start']['day']);
      $sender->addParameter('start_note', mb_convert_encoding($data['startNote'], 'EUC', 'UTF-8'));
      $sender->addParameter('location_pref_id', $data['locationPrefectureId']);
      $sender->addParameter('location_note', mb_convert_encoding($data['locationNote'], 'EUC', 'UTF-8'));
      $sender->addParameter('bbs_body', mb_convert_encoding($data['body'], 'EUC', 'UTF-8'));
      $sender->addParameter('deadline_year', $data['deadline']['year']);
      $sender->addParameter('deadline_month', $data['deadline']['month']);
      $sender->addParameter('deadline_day', $data['deadline']['day']);

      if (is_file($data['photo'])) {
        $sender->addUploadFile('photo1', $data['photo'], 'image/jpeg');
      }

      $parser = $sender->send();
      $contents = $parser->getContents();

      $pattern = '/\"rpc_post_key\":\"([\w]+)\"/s';
      if (!preg_match($pattern, $contents, $matches)) {
        $pattern = '/&quot;rpc_post_key&quot;:&quot;([\w]+)&quot;/s';

        if (!preg_match($pattern, $contents, $matches)) {
          $response->setStatus(400);
          throw new Mars_RequestException('Contents type is illegal.');
        }
      }

      $postKey = $matches[1];

      $pattern = '/name=\"packed\"\ value=\"(.*?)"\ \/>/s';
      if (!preg_match($pattern, $contents, $matches)) {
        $response->setStatus(400);
        throw new Mars_RequestException('Contents type is illegal.');
      }

      $packed = $matches[1];

      $sender->setRequestMethod(Mars_HttpRequest::HTTP_POST);
      $sender->setRequestPath('/add_event.pl');
      $sender->addParameter('submit', 'confirm');
      $sender->addParameter('title', mb_convert_encoding($data['title'], 'EUC', 'UTF-8'));
      $sender->addParameter('start_year', $data['start']['year']);
      $sender->addParameter('start_month', $data['start']['month']);
      $sender->addParameter('start_day', $data['start']['day']);
      $sender->addParameter('start_note', mb_convert_encoding($data['startNote'], 'EUC', 'UTF-8'));
      $sender->addParameter('location_pref_id', $data['locationPrefectureId']);
      $sender->addParameter('location_note', mb_convert_encoding($data['locationNote'], 'EUC', 'UTF-8'));
      $sender->addParameter('bbs_body', mb_convert_encoding($data['body'], 'EUC', 'UTF-8'));
      $sender->addParameter('deadline_year', $data['deadline']['year']);
      $sender->addParameter('deadline_month', $data['deadline']['month']);
      $sender->addParameter('deadline_day', $data['deadline']['day']);
      $sender->addParameter('post_key', $postKey);
      $sender->addParameter('packed', $packed);

      $parser = $sender->send();

      $contents = mb_convert_encoding($parser->getContents(), 'UTF-8', 'EUC');
      if ($parser->getStatus() != 200 || !preg_match('/作成が完了しました。/s', $contents)) {
        $this->response->setStatus(400);
        throw new Mars_RequestException('The request failed.');
      }

      preg_match('/view_event.pl\?&id=(.*)&/', $parser->getContents(), $matches);
      $mixiEventId = $matches[1];

      $mixiEvent = new MixiEvents();
      $mixiEvent->setMixiEventId($mixiEventId);
      $mixiEvent->setMixiCommunityId($community['communityId']);
      $mixiEvent->setEventId($eventId);
      $mixiEvent->setEventStatusType(MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE);

      $this->mixiEventsDAO->insert($mixiEvent);

      sleep(10);
    }
  }

  /**
   * createMixiCommunityComment
   *
   * @param array $data
   * @return object $sender
   * @author lude <lude@users.sourceforge.jp>
   */
  public function createMixiCommunityComment($data)
  {
    $response = Mars_DIContainerFactory::getContainer()->getResponse();

    $baseSender = $this->setMixiLoginSender();

    foreach ($data['mixiCommunityList'] as $community) {

      $sender = $baseSender;

      $sender->setRequestMethod(Mars_HttpRequest::HTTP_POST);
      $sender->setRequestPath('/add_event_comment.pl');
      $sender->setFollowLocation(FALSE);
      $sender->addParameter('id', $community['mixi_event_id']);
      $sender->addParameter('comment', mb_convert_encoding($data['comment'], 'EUC', 'UTF-8'));
      $sender->addParameter('comment', $data['comment']);

      $parser = $sender->send();

      $contents = $parser->getContents();

      $pattern = '/\"rpc_post_key\":\"([\w]+)\"/s';
      if (!preg_match($pattern, $contents, $matches)) {

        $pattern = '/&quot;rpc_post_key&quot;:&quot;([\w]+)&quot;/s';
        if (!preg_match($pattern, $contents, $matches)) {
          $response->setStatus(400);
          throw new Mars_RequestException('Contents type is illegal.');
        }
      }

      $postKey = $matches[1];

      $sender->setRequestMethod(Mars_HttpRequest::HTTP_POST);
      $sender->setRequestPath('/add_event_comment.pl');
      $sender->addParameter('submit', 'confirm');
      $sender->addParameter('id', $community['mixi_event_id']);
      $sender->addParameter('comm_id', $community['mixi_community_id']);
      $sender->addParameter('comment', mb_convert_encoding($data['comment'], 'EUC', 'UTF-8'));
      $sender->addParameter('post_key', $postKey);
      $sender->addParameter('packed', '');

      $parser = $sender->send();

      $contents = mb_convert_encoding($parser->getContents(), 'UTF-8', 'EUC');

      if ($parser->getStatus() != 200 || !preg_match('/書き込みが完了しました。/s', $contents)) {
        $this->response->setStatus(400);
        throw new Mars_RequestException('The request failed.');
      }
    }
  }

  /**
   * setMixiLoginSender
   *
   * @author lude <lude@users.sourceforge.jp>
   */
  public function setMixiLoginSender()
  {
    $managerId = $this->user->getAttribute('managerId');
    $account = $this->mixiAccountsDAO->find($managerId);

    $crypter = new Mars_Crypter();
    $password = $crypter->decrypt($account->getPassword());

    $mixiLoginSender = MixiService::mixiLogin($account->getMailAddress(), $password);

    return $mixiLoginSender;
  }

  /**
   * checkAccountExist
   *
   * @param int $loginId
   * @param int $mixiAccountId
   * @return bool
   * @author lude <lude@users.sourceforge.jp>
   */
  public function checkAccountExist($loginId, $mixiAccountId, $checkType)
  {
    $isError = FALSE;

    if ($this->managersDAO->existLoginId($loginId)) {
      $manager = $this->managersDAO->findByManagerId($this->user->getAttribute('managerId'));
      if ($manager->getLoginId() != $loginId || $checkType == self::ACCOUNT_CHECK_TYPE_ADD) {
        $this->messages->addError('ご入力いただいたログインIDは既に使用されています。別のログインIDを指定してください。', 1);
        $isError = TRUE;
      }
    }

    if ($this->mixiAccountsDAO->existMixiAccountId($mixiAccountId)) {
      $mixiAccount = $this->mixiAccountsDAO->find($this->user->getAttribute('managerId'));
      if ($mixiAccount->getMixiAccountId() != $mixiAccountId || $checkType == self::ACCOUNT_CHECK_TYPE_ADD) {
        $this->messages->addError('ご入力いただいたmixiIDは既に使用されています。', 2);
        $isError = TRUE;
      }
    }

    return $isError;
  }

  /**
   * getIconPreviewPath
   *
   * @param int $tokenId
   * @return string
   * @author lude <lude@users.sourceforge.jp>
   */
  public function getIconPreviewPath($tokenId)
  {
    return sprintf('%s/tmp/icons/%s', APP_ROOT_DIR, $tokenId);
  }
}
