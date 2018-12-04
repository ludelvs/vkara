<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/23/2011 23:45:06
 *
 * @package libs.dao
 */
class MixiEventsDAO extends Mars_DAO
{
  protected $_tableName = 'mixi_events';

  const EVENT_STATUS_TYPE_ACTIVE = 1;
  const EVENT_STATUS_TYPE_CLOSE = 2;
  const EVENT_STATUS_TYPE_DELETE = 3;

  /**
   * find
   *
   * @param array $condition
   * @return array
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function find($condition = array())
  {
    $conn = $this->getConnection();
    $innserSql = 'SELECT e.event_id, mc.image_url, mc.manager_id '
               . 'FROM events AS e '
               . 'INNER JOIN mixi_communities AS mc '
               . 'ON e.create_manager_id = mc.manager_id '
               . 'WHERE e.create_manager_id = :create_manager_id '
               . 'GROUP BY event_id';

    $sql = 'SELECT me.mixi_event_id, me.mixi_community_id, mco.mixi_community_name, mct.image_url, mct.manager_id, '
         . 'me.event_id, me.latest_comment_id, me.last_check_comment_id, me.event_status_type, '
         . 'DATE_FORMAT(me.register_date, \'%Y-%m-%d %H:%i\') AS register_date, DATE_FORMAT(me.comment_last_check_date, \'%Y-%m-%d %H:%i\') AS comment_last_check_date '
         . 'FROM mixi_events AS me '
         . 'INNER JOIN (' . $innserSql .  ') AS mct '
         . 'ON me.event_id = mct.event_id '
         . 'INNER JOIN mixi_communities AS mco '
         . 'ON me.mixi_community_id = mco.mixi_community_id '
         . 'WHERE 1 = 1 ';
    
    if ($condition['eventStatusType']) {
      $sql .= 'AND me.event_status_type = :event_status_type ';
    } else {
      $sql .= 'AND me.event_status_type != :event_status_type ';
    }

    $sql .= 'GROUP BY me.mixi_event_id';

    $pstmt = $conn->prepare($sql);

    $pstmt->bindParam(':create_manager_id', $condition['managerId']);

    if ($condition['eventStatusType']) {
      $pstmt->bindParam(':event_status_type', $condition['eventStatusType']);
    } else {
      $pstmt->bindValue(':event_status_type', MixiEventsDAO::EVENT_STATUS_TYPE_DELETE);
    }

    $pstmt->execute();

    $res = array();

    while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    }

    return $res;
  }

  /**
   * findEventIds
   *
   * @param int $managerId
   * @return array
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function findEventIds($managerId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT me.event_id '
         . 'FROM mixi_events AS me '
         . 'INNER JOIN mixi_communities AS mc '
         . 'ON me.mixi_community_id = mc.mixi_community_id '
         . 'WHERE mc.manager_id = :manager_id '
         . 'AND me.event_status_type = :event_status_type '
         . 'GROUP BY me.event_id '
         . 'ORDER BY me.event_id DESC';
    
    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $managerId);
    $pstmt->bindValue(':event_status_type', self::EVENT_STATUS_TYPE_ACTIVE);

    $pstmt->execute();

    $res = array();

    while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
      $res[$row['event_id']] = $row['event_id'];
    }

    return $res;
  }
  
  /**
   * insert
   *
   * @param array $mixiEvent
   * @return int
   * @author lude <lude@users.sourceforge.jp>
   */
  public function insert($mixiEvent)
  {
    $conn = $this->getConnection();

    $sql = 'INSERT INTO mixi_events (mixi_event_id, mixi_community_id, event_id, event_status_type, register_date) '
          .'VALUES (:mixi_event_id, :mixi_community_id, :event_id, :event_status_type, NOW())';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_event_id', $mixiEvent->getMixiEventId());
    $pstmt->bindParam(':mixi_community_id', $mixiEvent->getMixiCommunityId());
    $pstmt->bindParam(':event_id', $mixiEvent->getEventId());
    $pstmt->bindParam(':event_status_type', $mixiEvent->getEventStatusType());

    $pstmt->execute();
  }

  /**
   * updateLatestCommentId
   *
   * @param array $mixiEventId
   * @param array $latestCommentId
   * @return int
   * @author lude <lude@users.sourceforge.jp>
   */
  public function updateLatestCommentId($mixiEventId, $latestCommentId)
  {
    $conn = $this->getConnection();

    $sql = 'UPDATE mixi_events '
         . 'SET latest_comment_id = :latest_comment_id '
         . 'WHERE mixi_event_id = :mixi_event_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_event_id', $mixiEventId);
    $pstmt->bindParam(':latest_comment_id', $latestCommentId);

    $pstmt->execute();
  }

  /**
   * updateLastCheckComment
   *
   * @param array $mixiEventId
   * @return int
   * @author lude <lude@users.sourceforge.jp>
   */
  public function updateLastCheckComment($mixiEventId)
  {
    $conn = $this->getConnection();

    $sql = 'UPDATE mixi_events '
         . 'SET last_check_comment_id = latest_comment_id, '
         . 'comment_last_check_date = NOW() '
         . 'WHERE mixi_event_id = :mixi_event_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_event_id', $mixiEventId);
    
    $pstmt->execute();
  }

  /**
   * insert
   *
   * @param array $mixiEventId
   * @param array $eventStatusType
   * @return int
   * @author lude <lude@users.sourceforge.jp>
   */
  public function updateEventStatusType($mixiEventId, $eventStatusType)
  {
    $conn = $this->getConnection();

    $sql = 'UPDATE mixi_events '
         . 'SET event_status_type = :event_status_type '
         . 'WHERE mixi_event_id = :mixi_event_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_event_id', $mixiEventId);
    $pstmt->bindParam(':event_status_type', $eventStatusType);
    
    $pstmt->execute();
  }    
}
