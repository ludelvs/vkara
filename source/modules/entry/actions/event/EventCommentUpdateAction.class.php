<?php
/**
 * EventCommentUpdate
 *
 * @author lude <lude@users.sourceforge.jp>
 */
class EventCommentUpdateAction extends Mars_Action
{
  public function execute()
  { 
    $condition['managerId'] = $this->user->getAttribute('managerId');
    $condition['eventStatusType'] = MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE;

    $mixiEvents = $this->mixiEventsDAO->find($condition);

    foreach ($mixiEvents as $mixiEvent) {
      $sender = $this->systemService->setMixiLoginSender();
      $sender->setRequestMethod(Mars_HttpRequest::HTTP_GET);
      $sender->setRequestPath('/view_event.pl');
      $sender->addParameter('id', $mixiEvent['mixi_event_id']);
      $sender->addParameter('comm_id', $mixiEvent['mixi_community_id']);

      $parser = $sender->send();

      $pattern = '/<label\ for=\"commentCheck.*\">(.*)<\/label>/';
      preg_match_all($pattern, $parser->getContents(), $matches);

      if ($matches) {
        $latestCommentId = end($matches[1]);
        $this->mixiEventsDAO->updateLatestCommentId($mixiEvent['mixi_event_id'], $latestCommentId);
      }
    }
    
    return Mars_View::SUCCESS;
  }
}
