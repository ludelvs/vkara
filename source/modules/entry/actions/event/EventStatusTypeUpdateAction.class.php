<?php
/**
 * EventStatusTypeUpdate
 *
 * @author lude <lude@users.sourceforge.jp>
 * 
 */
class EventStatusTypeUpdateAction extends Mars_Action
{
  public function execute()
  { 

    $condition['managerId'] = $managerId = $this->user->getAttribute('managerId');
    
    $mixiEventId = $this->form->get('mixiEventId');
    $eventStatusType = $this->form->get('eventStatusType');
    
    $this->mixiEventsDAO->updateEventStatusType($mixiEventId, $eventStatusType);

    if ($eventStatusType == MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE) {
      $condition['eventStatusType'] = MixiEventsDAO::EVENT_STATUS_TYPE_CLOSE;
    } else {
      $condition['eventStatusType'] = MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE;
    }

    EventService::setRendererMixiEventAndStatusType($condition);

    return Mars_View::SUCCESS;

  }
}
