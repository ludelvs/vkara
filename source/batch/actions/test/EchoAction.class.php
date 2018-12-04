<?php
/**
 * This is test Action
 *
 * @author lude <lude@users.sourceforge.jp>
 */

class EchoAction extends Mars_Action
{


  public function execute()
  {
    
$aa = ArrayFunctions::arrayRecursiveKeySearch('mixi',Mars_Config::loadProperties());
print_r($aa);exit;

    $existCommunity = $this->mixiCommunitiesDAO->checkByManagerIdAndCommunityId(5, 5828327);
    if ($existCommunity) {
      echo 11;
    } else {
      echo 22;
    }
    exit;
    $contents = file_get_contents(APP_ROOT_DIR . '/logs/dlog.log');
    

  //$pattern = '/name=\"(org\.apache\.struts\.taglib\.html\.TOKEN)\"\ value="(.*?)"/s';
  $pattern = '/name=\"packed\"\ value=\"(.*?)"\ \/>/s';
  if (preg_match($pattern, $contents, $matches)){
    dlog($matches);exit;
    
foreach ($matches[2] as $key => $emojiId) {
    $contents = file_get_contents(sprintf('http://img.mixi.jp/img/emoji/%s.gif', $emojiId));
    
    file_put_contents(APP_ROOT_DIR . sprintf('/webroot/common/images/emoji/mixi/%s.gif', $matches[1][$key]), $contents);
  

}

exit;

    dlog($matches);
  }
  exit;
    $aa = $this->managersDAO->findByManagerId(1);
    dlog($aa);exit;
    
    echo strtotime('20110102'); print "\n";exit;
    
    $sql = 'UPDATE managers '
          .'SET login_id = :login_id, ';
    if (isset($manager['loginPassword'])) {
      $sql .= ' login_password = :login_password ';
    }
    $sql = rtrim($sql, ',');
    $sql .= 'WHERE manager_id = :manager_id';
dlog($sql);exit;    
    
    $contents = file_get_contents(APP_ROOT_DIR . '/logs/dlog.log');
//<div class="iconListImage"><a href="view_community.pl?id=5828327" style="background: url(http://img.mixi.net/img/basic/common/noimage_comm76.gif); text-indent: -9999px;" class="iconTitle" title="test1234">test1234?μ??</a></div><span>test1234(2)</span>
$pattern = '/view_community.pl\?id=(.*)"\ style.*url\((http:.*)\).*title="(.*)"/';
    preg_match_all($pattern, $contents, $matches);

    foreach ($matches[1] as $key => $value) {
      $communities[$key]['communityId'] = $value;
      $communities[$key]['communityName'] = $matches[3][$key];
      $communities[$key]['imageUrl'] = $matches[2][$key];
    }
    
print_r($communities);exit;    
    
    $config = Mars_Config::loadProperties();
$sender = MixiService::mixiLogin();
SystemService::getMixiCommunityList($sender);
//$res = array_find($config,'mixi');
    $res = ArrayFunctions::arrayRecursiveKeySearch('mixi', $config);
    dlog($res);
  }
  

}

