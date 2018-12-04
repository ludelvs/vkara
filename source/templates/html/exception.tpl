<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
  <head>
    <meta http-equiv="Content-Language" content="ja" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <title><?php echo $exceptionClassName ?></title>
    <link rel="stylesheet" type="text/css" href="/common/base/mars/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/common/base/mars/css/app_core.css" />
    <script type="text/javascript" src="/common/base/require.js"></script>
    <script type="text/javascript" src="/common/base/mars/js/exception.js"></script>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1><?php printf('%s: %s', $exceptionClassName, $exceptionTitle) ?></h1>
      </div>
      <div id="contents">
        <?php echo $trace ?>
      </div>
    </div>
  </body>
</html>
