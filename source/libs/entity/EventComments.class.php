<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 12/09/2011 02:49:56
 * 
 * @package libs.entity
 */
class EventComments extends Mars_Entity
{
  private $_eventCommentId;
  private $_eventId;
  private $_comment;
  private $_registerDate;

  public function setEventCommentId($eventCommentId)
  {
    $this->_eventCommentId = $eventCommentId;
  }

  public function getEventCommentId()
  {
    return $this->_eventCommentId;
  }

  public function setEventId($eventId)
  {
    $this->_eventId = $eventId;
  }

  public function getEventId()
  {
    return $this->_eventId;
  }

  public function setComment($comment)
  {
    $this->_comment = $comment;
  }

  public function getComment()
  {
    return $this->_comment;
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
