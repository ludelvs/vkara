<?php
/**
 * @package libs.helper
 * @author lude <lude@users.sourceforge.jp>
 */
class CustomHTMLHelper extends PluginHTMLHelper
{
  private $_properties = array();

  public function initialize()
  {
    $this->_properties = Mars_Config::loadProperties();
  }

  public function getCommunityLink($data)
  {
    $label = $data['mixi_community_name'];
    $url = sprintf('http://mixi.jp/view_community.pl?id=%s', $data['mixi_community_id']);
    $attribute = array('target' => '_blank');
    
    $link = $this->link($label, $url, $attribute);
    
    return $link;
  }    
  
  public function getEventLink($data)
  {
    $label = $data['newest_comment_count'];
    $url = sprintf('http://mixi.jp/view_event.pl?id=%s&comm_id=%s',$data['mixi_event_id'], $data['mixi_community_id']);
    $attribute = array('target' => '_blank', 'onclick' => 'checkEventComment(' . $data['mixi_event_id'] . ',' .  $data['mixi_community_id'] . ');');
    
    $link = $this->link($label, $url, $attribute);
    
    return $link;
  }
  
  public function getEventStatusUpdateLink($data)
  {
    $label = Mars_Config::loadProperties('eventStatusType.' . $data['event_status_type']);
    $url = 'javascript: void(0);';
    if ($data['event_status_type'] == MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE) {
      $eventStatusType = MixiEventsDAO::EVENT_STATUS_TYPE_CLOSE;
    } else {
      $eventStatusType = MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE;
    }
    $attribute = array('onclick' => 'updateEventStatusType(' . $data['mixi_event_id'] . ', ' . $eventStatusType . ');return false');
    
    $link = $this->link($label, $url, $attribute);
    
    return $link;
  }
  
  public function viewEventDeleteLink($data)
  {
    if ($data['event_status_type'] == MixiEventsDAO::EVENT_STATUS_TYPE_CLOSE) {

      $label = '削除';
      $url = 'javascript: void(0);';
      $attribute = array('onclick' => 'deleteEvent(' . $data['mixi_event_id'] .  ',' .  $data['event_status_type'] . ');return false');
      $separate = ' / ';
      $link = $this->link($label, $url, $attribute);

      return $separate . $link;
      
    }
  }
}
