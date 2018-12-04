<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/22/2011 04:14:52
 * 
 * @package libs.entity
 */
class MixiAccounts extends Mars_Entity
{
  private $_mixiAccountId;
  private $_managerId;
  private $_mailAddress;
  private $_password;
  private $_communityGroupId;
  private $_registerDate;
  private $_lastUpdateDate;

  public function setMixiAccountId($mixiAccountId)
  {
    $this->_mixiAccountId = $mixiAccountId;
  }

  public function getMixiAccountId()
  {
    return $this->_mixiAccountId;
  }

  public function setManagerId($managerId)
  {
    $this->_managerId = $managerId;
  }

  public function getManagerId()
  {
    return $this->_managerId;
  }

  public function setMailAddress($mailAddress)
  {
    $this->_mailAddress = $mailAddress;
  }

  public function getMailAddress()
  {
    return $this->_mailAddress;
  }

  public function setPassword($password)
  {
    $this->_password = $password;
  }

  public function getPassword()
  {
    return $this->_password;
  }

  public function setCommunityGroupId($communityGroupId)
  {
    $this->_communityGroupId = $communityGroupId;
  }

  public function getCommunityGroupId()
  {
    return $this->_communityGroupId;
  }

  public function setRegisterDate($registerDate)
  {
    $this->_registerDate = $registerDate;
  }

  public function getRegisterDate()
  {
    return $this->_registerDate;
  }

  public function setLastUpdateDate($lastUpdateDate)
  {
    $this->_lastUpdateDate = $lastUpdateDate;
  }

  public function getLastUpdateDate()
  {
    return $this->_lastUpdateDate;
  }


}
