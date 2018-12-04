<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/24/2011 00:09:45
 * 
 * @package libs.entity
 */
class Events extends Mars_Entity
{
  private $_eventId;
  private $_title;
  private $_startDate;
  private $_startNote;
  private $_locationPrefectureId;
  private $_locationNote;
  private $_body;
  private $_deadlineDate;
  private $_createManagerId;
  private $_registerDate;

  public function setEventId($eventId)
  {
    $this->_eventId = $eventId;
  }

  public function getEventId()
  {
    return $this->_eventId;
  }

  public function setTitle($title)
  {
    $this->_title = $title;
  }

  public function getTitle()
  {
    return $this->_title;
  }

  public function setStartDate($startDate)
  {
    $this->_startDate = $startDate;
  }

  public function getStartDate()
  {
    return $this->_startDate;
  }

  public function setStartNote($startNote)
  {
    $this->_startNote = $startNote;
  }

  public function getStartNote()
  {
    return $this->_startNote;
  }

  public function setLocationPrefectureId($locationPrefectureId)
  {
    $this->_locationPrefectureId = $locationPrefectureId;
  }

  public function getLocationPrefectureId()
  {
    return $this->_locationPrefectureId;
  }

  public function setLocationNote($locationNote)
  {
    $this->_locationNote = $locationNote;
  }

  public function getLocationNote()
  {
    return $this->_locationNote;
  }

  public function setBody($body)
  {
    $this->_body = $body;
  }

  public function getBody()
  {
    return $this->_body;
  }

  public function setDeadlineDate($deadlineDate)
  {
    $this->_deadlineDate = $deadlineDate;
  }

  public function getDeadlineDate()
  {
    return $this->_deadlineDate;
  }

  public function setCreateManagerId($createManagerId)
  {
    $this->_createManagerId = $createManagerId;
  }

  public function getCreateManagerId()
  {
    return $this->_createManagerId;
  }

  public function setRegisterDate($registerDate)
  {
    $this->_registerDate = $registerDate;
  }

  public function getRegisterDate()
  {
    return $this->_registerDate;
  }


}
