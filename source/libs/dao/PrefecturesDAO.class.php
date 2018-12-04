<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/22/2011 20:41:20
 * 
 * @package libs.dao
 */
class PrefecturesDAO extends Mars_DAO
{
  protected $_tableName = 'prefectures';
  
  /**
   * findAll
   * 
   * @return array
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function findAll()
  {
    $conn = $this->getConnection();
    $sql = 'SELECT prefecture_id, prefecture_name '
         . 'FROM prefectures';

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $res = array();

    while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    }

    return $res;
  }
  
  /**
   * findByPrefectureId
   * 
   * @param int $prefectureId
   * @return object
   * @author lude <lude@users.sourceforge.jp>
   */    
  public function findByPrefectureId($prefectureId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT prefecture_id, prefecture_name '
         . 'FROM prefectures '
         . 'WHERE prefecture_id = :prefecture_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':prefecture_id', $prefectureId);
    $pstmt->execute();

    $row = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      return $this->arrayToEntity($row);
    }

    return NULL;
  }    
}
