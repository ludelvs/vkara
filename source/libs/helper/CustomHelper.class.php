<?php
/**
 * @package libs.helper
 * @author lude <lude@users.sourceforge.jp>
 */
class CustomHelper extends Mars_Helper
{
  /**
   * getPrefecture
   * 
   * @param int $prefectureId
   * @return object
   * @author lude <lude@users.sourceforge.jp>
   */    
  public function getPrefectureName($prefectureId)
  {
    $prefecture = $this->prefecturesDAO->findByPrefectureId($prefectureId);
    
    return $prefecture->getPrefectureName();
  }

  public function getEnvironment($name = NULL, $alternative = NULL)
  {
    $container = Mars_DIContainerFactory::getContainer();
    return $container->getRequest()->getEnvironment($name, $alternative);
  }
  
  public function isManage()
  {
    return ManagersDAO::ROLE_TYPE_MANAGE;
  }
  
  public function isEdit()
  {
    return ManagersDAO::ROLE_TYPE_EDIT;
  }
  
  public function isInquiry()
  {
    return ManagersDAO::ROLE_TYPE_INQUIRY;
  }  
}