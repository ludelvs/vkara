<?php
/**
 * EventCommentCheck
 *
 * @author lude <lude@users.sourceforge.jp>
 * 
 */
class EventCommentCheckAction extends Mars_Action
{
  public function execute()
  { 

    $mixiEventId = $this->form->get('mixiEventId');

    $this->mixiEventsDAO->updateLastCheckComment($mixiEventId);
    
    $value['newest_comment_count'] = 0;
    $value['mixi_event_id'] = $mixiEventId;
    $value['mixi_community_id'] = $this->form->get('mixiCommunityId');
    
    $this->renderer->setAttribute('value', $value);
    
    Mars_View::SUCCESS;

  }
}
