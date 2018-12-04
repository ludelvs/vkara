<?php
/**
 * EventService
 * 
 * @auther lude <lude@users.sourceforge.jp>
 * @version $Id: EventService.class.php 69 2011-11-30 15:56:12Z kouda $
 */

class EventService extends Mars_DIComponent
{
  /**
   * getMixiCommunityList
   * 
   * @param array $condition
   * @author lude <lude@users.sourceforge.jp>
   */
  public function setRendererMixiEventAndStatusType($condition)
  {
    $mixiEvents = $this->mixiEventsDAO->find($condition);
   
    foreach ($mixiEvents as $key => $mixiEvent) {
      $mixiEvents[$key]['latest_comment_id'] = (isset($mixiEvent['latest_comment_id'])) ? $mixiEvent['latest_comment_id'] : 0;
      $mixiEvents[$key]['last_check_comment_id'] = (isset($mixiEvent['last_check_comment_id'])) ? $mixiEvent['last_check_comment_id'] : 0;
      $mixiEvents[$key]['newest_comment_count'] = $mixiEvents[$key]['latest_comment_id']  - $mixiEvents[$key]['last_check_comment_id'];
    }

    $this->renderer->setAttribute('selectedStatus', $condition['eventStatusType']);
    if ($mixiEvents) {
      $this->renderer->setAttribute('mixiEvents', $mixiEvents);
    }
  }
}
