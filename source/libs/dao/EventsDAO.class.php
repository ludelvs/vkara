<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/23/2011 23:45:06
 * 
 * @package libs.dao
 */
class EventsDAO extends Mars_DAO
{
  protected $_tableName = 'events';
  
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
    $sql = 'SELECT event_id, title, start_date, start_note, location_prefecture_id, location_note, body, deadline_date, create_manager_id, register_date '
         . 'FROM events '
         . 'WHERE 1 = 1 ';
    if ($condition['eventId']) {
      $sql .= 'AND event_id = :event_id ';
    }
    if ($condition['createManagerId']) {
      $sql .= 'AND create_manager_id = :create_manager_id ';
    }    

    $pstmt = $conn->prepare($sql);

    if ($condition['eventId']) {
      $pstmt->bindParam(':event_id', $condition['eventId']);
    }

    if ($condition['createManagerId']) {
      $pstmt->bindParam(':create_manager_id', $condition['createManagerId']);
    }

    $pstmt->execute();

    $res = array();

    while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
      $res[] = $row;
    }
    
    if (count($res) == 1) {
      $res = $res[0];
    }

    return $res;
  }
  
  /**
   * insert
   *
   * @param array $event
   * @return int
   * @author lude <lude@users.sourceforge.jp>
   */
  public function insert($event)
  {
    $conn = $this->getConnection();

    $sql = 'INSERT INTO events (title, start_date, start_note, location_prefecture_id, location_note, body, '
          .'deadline_date, create_manager_id, register_date) '
          .'VALUES(:title, :start_date, :start_note, :location_prefecture_id, :location_note, :body, '
          .':deadline_date, :create_manager_id, NOW())';

    $startDate = sprintf('%s-%s-%s', $event['start']['year'], $event['start']['month'], $event['start']['day']);
    $deadlinetDate = sprintf('%s-%s-%s', $event['deadline']['year'], $event['deadline']['month'], $event['deadline']['day']);
    
    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':title', $event['title']);
    $pstmt->bindParam(':start_date', $startDate);
    $pstmt->bindParam(':start_note', $startNote = ($event['startNote'] != NULL) ? $event['startNote'] : NULL);
    $pstmt->bindParam(':location_prefecture_id', $event['locationPrefectureId']);
    $pstmt->bindParam(':location_note', $locationNote = ($event['locationNote'] != NULL) ? $event['locationNote'] : NULL);
    $pstmt->bindParam(':body', $event['body']);
    $pstmt->bindParam(':deadline_date', $deadlinetDate);
    $pstmt->bindParam(':create_manager_id', $this->user->getAttribute('managerId'));

    $pstmt->execute();

    return $conn->lastInsertId();
  }
}
