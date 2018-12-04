<?php
/**
 * EventDetail
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventDetailAction.class.php 42 2011-11-28 09:07:53Z kouda $
 */
class EventDetailAction extends Mars_Action
{
  public function execute()
  {
    $condition['eventId'] = $this->request->getPathInfo('eventId');
    $condition['managerId'] = $this->user->getAttribute('managerId');
    $event = $this->eventsDAO->find($condition);
    $event['start_date'] = explode('-', $event['start_date']);
    $event['deadline_date'] = explode('-', $event['deadline_date']);

    $this->renderer->setAttribute('event', $event);
    
    return Mars_View::SUCCESS;
  }
}