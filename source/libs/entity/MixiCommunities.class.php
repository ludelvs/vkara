<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 12/09/2011 02:40:43
 * 
 * @package libs.entity
 */
class MixiCommunities extends Mars_Entity
{
  private $_mixiCommunityId;
  private $_mixiCommunityName;
  private $_imageUrl;
  private $_managerId;
  private $_registerDate;

  public function setMixiCommunityId($mixiCommunityId)
  {
    $this->_mixiCommunityId = $mixiCommunityId;
  }

  public function getMixiCommunityId()
  {
    return $this->_mixiCommunityId;
  }

  public function setMixiCommunityName($mixiCommunityName)
  {
    $this->_mixiCommunityName = $mixiCommunityName;
  }

  public function getMixiCommunityName()
  {
    return $this->_mixiCommunityName;
  }

  public function setImageUrl($imageUrl)
  {
    $this->_imageUrl = $imageUrl;
  }

  public function getImageUrl()
  {
    return $this->_imageUrl;
  }

  public function setManagerId($managerId)
  {
    $this->_managerId = $managerId;
  }

  public function getManagerId()
  {
    return $this->_managerId;
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
