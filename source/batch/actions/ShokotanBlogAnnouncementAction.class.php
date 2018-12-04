<?php
/**
 *  ShokotanBlogAnnouncement
 *
 * @author lude <lude@users.sourceforge.jp>
 */

class  ShokotanBlogAnnouncementAction extends Mars_Action
{


  public function execute()
  {
    require_once(APP_ROOT_DIR . '/vendors/qdmail.php');

    $sender = new Mars_HttpRequestSender();
    $sender->setBaseURI('http://s.ameblo.jp');
    $sender->setRequestMethod(Mars_HttpRequest::HTTP_GET);
    $sender->setUserAgent('Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_0 like Mac OS X; en-us) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8A293 Safari/6531.22.7');
    $sender->setRequestPath('/nakagawa-shoko/');

    $parser = $sender->send();
    $contents = $parser->getContents();

    $pattern = '/<a href="http:\/\/s\.ameblo\.jp\/nakagawa-shoko\/(entry-\d+\.html)"\ class="entryTitle">/';
    preg_match($pattern, $contents, $matches);

    $sender->setRequestPath('/nakagawa-shoko/' . $matches[1]);
    $parser = $sender->send();
    $contents = $parser->getContents();

    $pattern = '/<h1\ id="contentsTitle">(.*)<\/h1>/';
    preg_match($pattern, $contents, $matches);

    $subject = htmlspecialchars_decode($matches[1]);

    $pattern = '/<article>(.*?)<\/article>/s';
    preg_match($pattern, $contents, $matches);
    $pattern = array();
    $pattern[] = '/<p>/';
    $pattern[] = '/<\/p>/';
    $pattern[] = '/&nbsp;/';
    $pattern[] = '/<div><\/div>/';
    $replacements = array();
    $replacements[] = '<div>';
    $replacements[] = '</div>';

    $body = trim($matches[1]);
    $body = preg_replace($pattern, $replacements, $body);

    $pattern = '/<img.*?src="(http:.*?(\d+\.(gif|jpg)))"/';
    preg_match_all($pattern, $body, $matches);

    $photoDir = APP_ROOT_DIR . '/webroot/common/images/shokotanblog';
    $photoSaveDirOrg = $photoDir . '/original';
    $photoSaveDirSmall = $photoDir . '/small';

    if (!is_dir($photoSaveDirOrg)) {
      mkdir($photoSaveDirOrg);
    }
    if (!is_dir($photoSaveDirSmall)) {
      mkdir($photoSaveDirSmall);
    }

    $attach = array();
    $imageObj = Mars_ImageFactory::create();

    foreach ($matches[1] as $key => $value) {
      $image = file_get_contents($value);
      $photoPath = $photoSaveDirOrg . '/' . $key . $matches[2][$key];
      write_file($photoPath, $image);
      $imageObj->load($photoPath);
      
      if ($matches[3][$key] == 'jpg') {
        $imageObj->resizeByPercent(90, 90);
        $photoPath = $photoSaveDirSmall . '/' . $key . $matches[2][$key];
        $imageObj->save($photoPath);
      }
       
      $attach = array_merge($attach, array(array($photoPath)));
      dlog($photoPath);
    }

    $body = mb_convert_kana($body, "KV", 'UTF-8');

    $mobileBody = $body;

    // 同一画像でも表示できるように異なるcidを付与するための措置
    foreach ($matches[2] as $key => $value) {
      $mobileBody = preg_replace('/o' . $value . '/', $key . $value, $mobileBody, 1);
    }

    $mobileBody = preg_replace('/<img.*?src="(http:.*?(\d+\.(jpg|gif)))".*?>/', '<img src="cid:$2">', $mobileBody);
    $mobileBody = trim($mobileBody);
    $patterns = array();
    $patterns[] = '/<a\ href=\"#\">/';
    $patterns[] = '/<\/a>/';
    $replacements = array();
    $mobileBody = preg_replace($patterns, $replacements, $mobileBody);
    $mobileBody = '<html><body>' . $mobileBody . '</body></html>';

    $user[0]['mail_address'] = 'brand_new_style@docomo.ne.jp';
    $user[1]['mail_address'] = 'vgns92ps@gmail.com';

    $user[0]['agent'] = 2;
    $user[1]['agent'] = 1;

    $type = 'deco';
    $from = array('shokotan@bit-server.thruhere.net', 'しょこたん☆ぶろぐ');;

    foreach ($user as $val) {
      $to = $val['mail_address'];
      if ($val['agent'] == 2) {
        $contents = $mobileBody;
      } else {
        $contents = $body; 
      }
      qd_send_mail($type, $to, $subject, $contents, $from, $attach);
    }
    remove_dir($photoSaveDirOrg);
    remove_dir($photoSaveDirSmall);
  }
}

