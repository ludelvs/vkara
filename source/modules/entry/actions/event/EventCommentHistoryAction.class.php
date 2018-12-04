<?php
/**
 * EventCommentHistory
 *
 * @author lude <lude@users.sourceforge.jp>
 */
class EventCommentHistoryAction extends Mars_Action
{
  public function execute()
  { 
    $managerId = $this->user->getAttribute('managerId');
    $mixiEventIds = $this->mixiEventsDAO->findEventIds($managerId);

    if ($this->form->get('eventId') !== NULL && $this->form->get('selectFlag')) {
      $selectedEventId = $this->form->get('eventId');
      $view = 'eventSelect';
    } else {
      $selectedEventId = reset($mixiEventIds);
      $view = Mars_View::SUCCESS;
    }
dlog($selectedEventId);
    $eventComments = $this->eventCommentsDAO->findByManagerIdAndEventId($managerId, $selectedEventId);
    
    $this->renderer->setAttribute('selectedEventId', $selectedEventId);
    $this->renderer->setAttribute('mixiEventIds', $mixiEventIds);
    $this->renderer->setAttribute('eventComments', $eventComments);
    
    return $view;
  }
}
