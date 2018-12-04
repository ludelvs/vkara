<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 12/09/2011 02:49:56
 * 
 * @package libs.dao
 */
class EventCommentsDAO extends Mars_DAO
{
  protected $_tableName = 'event_comments';
  
  /**
   * find
   *
   * @param int $managerId
   * @param int $eventId
   * @return array
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function findByManagerIdAndEventId($managerId, $eventId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT ec.event_comment_id, ec.event_id, ec.comment, DATE_FORMAT(ec.register_date, \'%Y-%m-%d %H:%i\') AS register_date '
         . 'FROM event_comments AS ec '
         . 'INNER JOIN events AS e '
         . 'ON ec.event_id = e.event_id '
         . 'WHERE e.create_manager_id = :manager_id '
         . 'AND ec.event_id = :event_id '
         . 'ORDER BY ec.register_date ASC';

    $pstmt = $conn->prepare($sql);

    $pstmt->bindParam(':manager_id', $managerId);
    $pstmt->bindParam(':event_id', $eventId);

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
   * @param array $eventComment
   * @author lude <lude@users.sourceforge.jp>
   */
  public function insert($eventComment)
  {
    $conn = $this->getConnection();

    $sql = 'INSERT INTO event_comments (event_id, comment, register_date) '
          .'VALUES (:event_id, :comment, NOW())';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':event_id', $eventComment->getEventId());
    $pstmt->bindParam(':comment', $eventComment->getComment());

    $pstmt->execute();
  }  
}
