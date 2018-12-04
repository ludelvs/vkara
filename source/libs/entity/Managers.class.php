<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 12/09/2011 01:55:28
 * 
 * @package libs.entity
 */
class Managers extends Mars_Entity
{
  private $_managerId;
  private $_loginId;
  private $_loginPassword;
  private $_managerName;
  private $_roleType;
  private $_lastLoginDate;
  private $_registerDate;
  private $_lastUpdateDate;
  private $_deleteFlag;

  public function setManagerId($managerId)
  {
    $this->_managerId = $managerId;
  }

  public function getManagerId()
  {
    return $this->_managerId;
  }

  public function setLoginId($loginId)
  {
    $this->_loginId = $loginId;
  }

  public function getLoginId()
  {
    return $this->_loginId;
  }

  public function setLoginPassword($loginPassword)
  {
    $this->_loginPassword = $loginPassword;
  }

  public function getLoginPassword()
  {
    return $this->_loginPassword;
  }

  public function setManagerName($managerName)
  {
    $this->_managerName = $managerName;
  }

  public function getManagerName()
  {
    return $this->_managerName;
  }

  public function setRoleType($roleType)
  {
    $this->_roleType = $roleType;
  }

  public function getRoleType()
  {
    return $this->_roleType;
  }

  public function setLastLoginDate($lastLoginDate)
  {
    $this->_lastLoginDate = $lastLoginDate;
  }

  public function getLastLoginDate()
  {
    return $this->_lastLoginDate;
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

  public function setDeleteFlag($deleteFlag)
  {
    $this->_deleteFlag = $deleteFlag;
  }

  public function getDeleteFlag()
  {
    return $this->_deleteFlag;
  }


}
