<?php
/**
 * YUI Compressorによって圧縮されたjsファイルとcssファイルを作成します。
 *
 * 設定ファイルがない場合は、全ての対象js,cssファイルを処理します。
 * ex)
 *   元ファイル: jquery/jquery-1.4.2.js の場合、
 *   圧縮ファイル: jquery/min/jquery-1.4.2.js に作成される
 *
 * 設定ファイル記述:
 * APP_ROOT_DIR/config/yuic_file_create.yml に圧縮したいファイルを記述
 * js:
 *  head:
 *    - "jquery/jquery-1.4.2.js"
 *    - "jquery/jquery.effects.core.js"
 *    - "jquery/jquery.effects.blind.js"
 *
 * の場合、jquery-1.4.2.js、jquery.effects.core.js、jquery.effects.blind.js の内容を
 * まとめた、APP_ROOT_DIR/webroot/common/js/min/head.js が作成されます。
 * 構成するファイルが存在しない場合は、そのファイルを含む圧縮ファイルに関する確認メッセージが出力されます。
 *
 * @author Hiroshi Kouda <kouda@dtx.co.jp>
 */

class MinifyFileCreateByYUICompressorAction extends Mars_Action
{
  private $_commonDir;
  private $_yuicExecFile;

  public function __construct()
  {
    $this->_commonDir = APP_ROOT_DIR . '/webroot/common/';
    $this->_yuicExecFile = APP_ROOT_DIR . '/vendors/yuicompressor-2.4.6.jar';
    
    if (!is_file($this->_yuicExecFile)) {
      $message = 'YUI Compressor library is not found.';
      Mars_Logger::getLogger(get_class())->error($message);
      echo $message . "\n";
      die();
    }
  }

  public function execute()
  {
    $this->minifyAll();
    $this->minifyCombine();
  }

  private function minifyAll()
  {
    $types = array('js', 'css');

    foreach ($types as $type) {
      $searchDir = sprintf('%s/webroot/common/%s', APP_ROOT_DIR, $type);
      $command = sprintf("find %s -type d  -name 'min'", $searchDir);
      $result = shell_exec($command);

      $result = rtrim($result, "\n");
      $result = explode("\n", $result);
      $result = array('excludes' => $result);

      $regExp =  sprintf('/.*\.%s$/', $type);
      $files = file_search($searchDir, $regExp, $result);

      foreach ($files as $file) {
        $minifyDir = substr($file, 0, strrpos($file, '/')) . '/min/';

        if (!is_dir($minifyDir)) {
          create_dir($minifyDir, array(0775));
        }

        $this->minify($type, $file, $minifyDir);

      }
    }
  }

  private function minifyCombine()
  {
    $minifyConfig = Mars_Config::loadProperties('minify');

    if (!$minifyConfig) {
      return NULL;
    }

    foreach ($minifyConfig as $type => $contents) {
      foreach ($contents as $key => $files) {
        $filePath = substr($key, 0, strripos($key, '/'));
        $fileName = ltrim(substr($key, strripos($key, '/')), '/');
        $minifyDir = sprintf('%s%s/%s/min/', $this->_commonDir, $type, $filePath);
        $minifyFile = sprintf('%s%s/%s/min/%s.%s', $this->_commonDir, $type, $filePath, $fileName, $type);

        $command = sprintf('rm -f %s*', $minifyFile);

        shell_exec($command);

        foreach ($files as  $file) {
          $this->minify($type, $file, $minifyDir, $fileName);

        }
      }
    }
  }

  private function minify($type, $file, $minifyDir, $fileName = NULL)
  {
    $sourceFile = sprintf('%s%s/%s ', $this->_commonDir, $type, $file);

    if (!$fileName) {
      $minifyFile = ltrim(substr($file, strrpos($file, '/')), '/');
      remove_file($minifyDir . $minifyFile);
      $sourceFile = $file;
    } else {
      $minifyFile = sprintf('%s.%s', $fileName, $type);
    }

    $sourceFile = rtrim($sourceFile);
    $tempMinimizeFile = sprintf('%s.tmp', $minifyFile);


    if (!is_file($sourceFile)) {
      echo $sourceFile . ' is not exist. please check config ' . $type . '.' . $fileName . " attribute.\n";
      continue;
    }
    $tempMinimizeFile = $minifyDir . $tempMinimizeFile;

    $options['--charset'] = 'utf-8';
    $options['--type'] = $type;
    $options['--nomunge'] = $sourceFile;
    $options['-o'] = $tempMinimizeFile;

    foreach ($options as $optionKey => $option) {
      $optionString .= sprintf('%s %s ', $optionKey, $option);
    }

    $command = sprintf("java -jar %s %s 2>&1", $this->_yuicExecFile, $optionString);
    $result = shell_exec($command);
    if ($result) {
      echo 'fileName: '. $sourceFile . " is incorrect grammar\n";
      exit;
    }

    $command = sprintf("cd %s && cat %s >> %s", $minifyDir, $tempMinimizeFile, $minifyFile);
    shell_exec($command);

    $command = sprintf("cd %s && echo '' >> %s", $minifyDir, $minifyFile);
    shell_exec($command);

    unlink($tempMinimizeFile);

  }
}
