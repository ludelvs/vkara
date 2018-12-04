<?php
/**
 * EventCommentAddForm
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventCommentAddFormAction.class.php 82 2011-12-10 15:51:06Z kouda $
 */
class EventCommentAddFormAction extends Mars_Action
{
  public function execute()
  {
    // トランザクショントークンを発行
    $this->user->saveToken();
    
    $managerId = $this->user->getAttribute('managerId');

    $mixiEventIds = $this->mixiEventsDAO->findEventIds($managerId);
    
    if ($this->form->get('eventId') !== NULL && $this->form->get('selectFlag')) {
      $selectedEventId = $this->form->get('eventId');
      $view = 'eventSelect';
    } else {
      $selectedEventId = reset($mixiEventIds);
      $view = Mars_View::SUCCESS;
    }
    
    
    $this->renderer->setAttribute('selectedEventId', $selectedEventId);
    $this->renderer->setAttribute('mixiEventIds', $mixiEventIds);
    
    return $view;
  }
}
