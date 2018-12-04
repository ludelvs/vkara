<?php
/**
 * EventList
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventListAction.class.php 68 2011-11-30 15:41:17Z kouda $
 */
class EventListAction extends Mars_Action
{
  public function execute()
  {
    $condition['managerId'] = $managerId = $this->user->getAttribute('managerId');

    if ($this->form->get('eventStatusType') !== NULL && $this->form->get('selectFlag')) {
      $condition['eventStatusType'] = $this->form->get('eventStatusType');
      $view = 'mixiEventListTable';
    } else {
      $condition['eventStatusType'] = MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE;
      $view = Mars_View::SUCCESS;
    }

    EventService::setRendererMixiEventAndStatusType($condition);

    return $view;
  }
}
