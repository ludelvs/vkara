<?php
/**
 * EventDelete
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventDeleteAction.class.php 68 2011-11-30 15:41:17Z kouda $
 */
class EventDeleteAction extends Mars_Action
{
  public function execute()
  {
    $condition['managerId'] = $managerId = $this->user->getAttribute('managerId');
    
    $mixiEventId = $this->form->get('mixiEventId');
    $condition['eventStatusType'] = $this->form->get('eventStatusType');
    
    $this->mixiEventsDAO->updateEventStatusType($mixiEventId, MixiEventsDAO::EVENT_STATUS_TYPE_DELETE);

    EventService::setRendererMixiEventAndStatusType($condition);

    return Mars_View::SUCCESS;
  }
}
