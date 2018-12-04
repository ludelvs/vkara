<?php
/**
 * EventAddForm
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventAddFormAction.class.php 42 2011-11-28 09:07:53Z kouda $
 */
class EventAddFormAction extends Mars_Action
{
  public function execute()
  {
    // トランザクショントークンを発行
    $this->user->saveToken();
    
    $prefectures = $this->prefecturesDAO->findAll();

    foreach ($prefectures as $prefecture) {
      $prefectureIds[] = $prefecture['prefecture_id'];
      $prefectureNames[] = $prefecture['prefecture_name'];
    }
    $this->renderer->setAttribute('prefectureIds', $prefectureIds);
    $this->renderer->setAttribute('prefectureNames', $prefectureNames);
    
    return Mars_View::SUCCESS;
  }
}
