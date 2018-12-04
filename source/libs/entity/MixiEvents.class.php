<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/24/2011 22:16:23
 * 
 * @package libs.entity
 */
class MixiEvents extends Mars_Entity
{
  private $_mixiEventId;
  private $_mixiCommunityId;
  private $_eventId;
  private $_latestCommentId;
  private $_lastCheckCommentId;
  private $_eventStatusType;
  private $_registerDate;
  private $_commentLastCheckDate;

  public function setMixiEventId($mixiEventId)
  {
    $this->_mixiEventId = $mixiEventId;
  }

  public function getMixiEventId()
  {
    return $this->_mixiEventId;
  }

  public function setMixiCommunityId($mixiCommunityId)
  {
    $this->_mixiCommunityId = $mixiCommunityId;
  }

  public function getMixiCommunityId()
  {
    return $this->_mixiCommunityId;
  }

  public function setEventId($eventId)
  {
    $this->_eventId = $eventId;
  }

  public function getEventId()
  {
    return $this->_eventId;
  }

  public function setLatestCommentId($latestCommentId)
  {
    $this->_latestCommentId = $latestCommentId;
  }

  public function getLatestCommentId()
  {
    return $this->_latestCommentId;
  }

  public function setLastCheckCommentId($lastCheckCommentId)
  {
    $this->_lastCheckCommentId = $lastCheckCommentId;
  }

  public function getLastCheckCommentId()
  {
    return $this->_lastCheckCommentId;
  }

  public function setEventStatusType($eventStatusType)
  {
    $this->_eventStatusType = $eventStatusType;
  }

  public function getEventStatusType()
  {
    return $this->_eventStatusType;
  }

  public function setRegisterDate($registerDate)
  {
    $this->_registerDate = $registerDate;
  }

  public function getRegisterDate()
  {
    return $this->_registerDate;
  }

  public function setCommentLastCheckDate($commentLastCheckDate)
  {
    $this->_commentLastCheckDate = $commentLastCheckDate;
  }

  public function getCommentLastCheckDate()
  {
    return $this->_commentLastCheckDate;
  }


}
