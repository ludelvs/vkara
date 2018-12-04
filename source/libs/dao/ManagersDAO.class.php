<?php
/**
 * This class was generated automatically by DAO Generator.
 * 
 * @package libs.dao
 * @author lude <lude@users.sourceforge.jp>
 */
class ManagersDAO extends Mars_DAO
{
  const ROLE_TYPE_MANAGE = 1;
  const ROLE_TYPE_EDIT = 2;
  const ROLE_TYPE_INQUIRY = 3;
  
  /**
   * find
   *
   * @param int $loginId
   * @param int $loginPassword
   * @return object
   * @author lude <lude@users.sourceforge.jp>
   */   
  public function find($loginId, $loginPassword)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT manager_id, login_id, login_password, manager_name, role_type, last_login_date, register_date, last_update_date, delete_flag '
         . 'FROM managers '
         . 'WHERE login_id = :login_id '
         . 'AND login_password = :login_password '
         . 'AND delete_flag = 0';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':login_id', $loginId);
    $pstmt->bindParam(':login_password', $loginPassword);
    $pstmt->execute();

    $row = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      return $this->arrayToEntity($row);
    }

    return NULL;
  }
  
  /**
   * findByManagerId
   *
   * @param int $managerId
   * @return object
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function findByManagerId($managerId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT manager_id, login_id, login_password, manager_name, role_type, last_login_date, register_date, last_update_date, delete_flag '
         . 'FROM managers '
         . 'WHERE manager_id = :manager_id '
         . 'AND delete_flag = 0';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $managerId);
    $pstmt->execute();

    $row = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      return $this->arrayToEntity($row);
    }

    return NULL;
  }
  
  /**
   * existLoginId
   *
   * @param int $loginId
   * @return bool
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function existLoginId($loginId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT login_id '
         . 'FROM managers '
         . 'WHERE login_id = :login_id '
         . 'AND delete_flag = 0';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':login_id', $loginId);
    $pstmt->execute();

    $row = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * insert
   * 
   * @param object $manager
   * @return int
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function insert($manager)
  {
    $conn = $this->getConnection();
    $sql = 'INSERT INTO  managers (login_id, login_password, manager_name, register_date) '
         . 'VALUES(:login_id, :login_password, :manager_name, NOW())';
    
    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':login_id', $manager->getLoginId());
    $pstmt->bindParam(':login_password', $manager->getLoginPassword());
    $pstmt->bindParam(':manager_name', $manager->getManagerName());
    
    $pstmt->execute();
    
    return $conn->lastInsertId();
  }  
  
  /**
   * update
   *
   * @param array $manager
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function update($manager)
  {
    $conn = $this->getConnection();
    $sql = 'UPDATE managers '
          .'SET login_id = :login_id, manager_name = :manager_name, ';
    if (isset($manager['loginPassword'])) {
      $sql .= ' login_password = :login_password, ';
    }
    $sql .= 'last_update_date = NOW() '
           .'WHERE manager_id = :manager_id';
    
    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $manager['managerId']);
    $pstmt->bindParam(':manager_name', $manager['managerName']);
    $pstmt->bindParam(':login_id', $manager['loginId']);
    if (isset($manager['loginPassword'])) {
      $pstmt->bindParam(':login_password', $manager['loginPassword']);
    }
    
    $pstmt->execute();
  }
  
  /**
   * updateLastLoginDate
   *
   * @param int $managerId
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function updateLastLoginDate($managerId)
  {
    $conn = $this->getConnection();
    $sql = 'UPDATE managers '
         . 'SET last_login_date = NOW() '
         . 'WHERE manager_id = :manager_id';
    
    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $managerId);
    
    $pstmt->execute();
  }  
}
