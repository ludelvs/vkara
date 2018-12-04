<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/24/2011 13:05:20
 * 
 * @package libs.dao
 */
class MixiCommunitiesDAO extends Mars_DAO
{
  protected $_tableName = 'mixi_communities';
  
  /**
   * findByManagerId
   * 
   * @param int $managerId
   * @return array
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function findByManagerId($managerId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT mixi_community_id, mixi_community_name, image_url, manager_id '
         . 'FROM mixi_communities '
         . 'WHERE manager_id = :manager_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $managerId);
    $pstmt->execute();

    $res = array();

    while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    }

    return $res;
  }
  
  /**
   * findByManagerIdAndEventId
   * 
   * @param int $managerId
   * @param int $eventId
   * @return array
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function findByManagerIdAndEventId($managerId, $eventId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT mc.mixi_community_id, mc.mixi_community_name, me.mixi_event_id '
         . 'FROM mixi_communities as mc '
         . 'INNER JOIN mixi_events as me '
         . 'ON mc.mixi_community_id = me.mixi_community_id '
         . 'WHERE mc.manager_id = :manager_id '
         . 'AND me.event_id = :event_id '
         . 'AND me.event_status_type = :event_status_type';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $managerId);
    $pstmt->bindParam(':event_id', $eventId);
    $pstmt->bindValue(':event_status_type', MixiEventsDAO::EVENT_STATUS_TYPE_ACTIVE);
    $pstmt->execute();

    $res = array();

    while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    }

    return $res;
  }
  
  /**
   * insert
   *
   * @param array $mixiCommunity
   * @author lude <lude@users.sourceforge.jp>
   */
  public function insert($mixiCommunity)
  {
    $conn = $this->getConnection();

    $sql = 'INSERT INTO mixi_communities (mixi_community_id, mixi_community_name, image_url, manager_id, register_date) '
          .'VALUES (:mixi_community_id, :mixi_community_name, :image_url, :manager_id, NOW())';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_community_id', $mixiCommunity['communityId']);
    $pstmt->bindParam(':mixi_community_name', $mixiCommunity['communityName']);
    $pstmt->bindParam(':image_url', $mixiCommunity['imageUrl']);
    $pstmt->bindParam(':manager_id', $mixiCommunity['managerId']);

    $pstmt->execute();
  }
  
  /**
   * delete
   *
   * @param int $managerId
   * @author lude <lude@users.sourceforge.jp>
   */
  public function delete($managerId)
  {
    $conn = $this->getConnection();

    $sql = 'DELETE FROM mixi_communities '
         . 'WHERE manager_id = :manager_id';


    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $managerId);

    $pstmt->execute();
  }    
}
