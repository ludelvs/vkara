<?php
/**
 * This class was generated automatically by DAO Generator.
 * date: 11/22/2011 04:14:52
 * 
 * @package libs.dao
 */
class MixiAccountsDAO extends Mars_DAO
{
  protected $_tableName = 'mixi_accounts';
  
  /**
   * find
   *
   * @param int $managerId
   * @return object
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function find($managerId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT mixi_account_id, manager_id, mail_address, password, community_group_id, register_date, last_update_date '
         . 'FROM mixi_accounts '
         . 'WHERE manager_id = :manager_id';

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
   * existMixiAccountId
   *
   * @param int $mixiAccountId
   * @return bool
   * @author lude <lude@users.sourceforge.jp>
   */  
  public function existMixiAccountId($mixiAccountId)
  {
    $conn = $this->getConnection();
    $sql = 'SELECT mixi_account_id '
         . 'FROM mixi_accounts '
         . 'WHERE mixi_account_id = :mixi_account_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_account_id', $mixiAccountId);
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
    $sql = 'INSERT INTO  mixi_accounts (mixi_account_id, manager_id, mail_address, password, community_group_id, register_date) '
         . 'VALUES(:mixi_account_id, :manager_id, :mail_address, :password, :community_group_id, NOW())';
    
    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':mixi_account_id', $manager->getMixiAccountId());
    $pstmt->bindParam(':manager_id', $manager->getManagerId());
    $pstmt->bindParam(':mail_address', $manager->getMailAddress());
    $pstmt->bindParam(':password', $manager->getPassword());
    $pstmt->bindParam(':community_group_id', $manager->getCommunityGroupId());
    
    $pstmt->execute();
  }

  /**
   * update
   *
   * @param array $account
   * @author lude <lude@users.sourceforge.jp>
   */   
  public function update($account)
  {
    $conn = $this->getConnection();
    $sql = 'UPDATE mixi_accounts '
          .'SET mail_address = :mail_address, '
          .'    community_group_id = :community_group_id, ';
    if (isset($account['mixiPassword'])) {
      $sql .= ' password = :password, ';
    }
    $sql .= 'last_update_date = NOW() '
           .'WHERE manager_id = :manager_id';

    $pstmt = $conn->prepare($sql);
    $pstmt->bindParam(':manager_id', $account['managerId']);
    $pstmt->bindParam(':mail_address', $account['mailAddress']);
    $pstmt->bindParam(':community_group_id', $account['communityGroupId']);
    if (isset($account['mixiPassword'])) {
      $pstmt->bindParam(':password', $account['mixiPassword']);
    }
    
    $pstmt->execute();
  }    
}
