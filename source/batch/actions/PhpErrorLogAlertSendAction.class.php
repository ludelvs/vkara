<?php
/**
 * ファイルに出力されたPHPのエラーをメール通知します。
 *
 * @author hiroshi kouda <kouda@dtx.co.jp>
 * @version $Id: $
 */
class PhpErrorLogAlertSendAction extends Mars_Action
{

  public function execute()
  {
    $errorLogFile = APP_ROOT_DIR . '/logs/php_error.log';

    $logMessages = PluginLogService::getLatestLogMessages($errorLogFile);

    if ($logMessages !== NULL) {
      Mars_Logger::getLogger(get_class())->fatal($logMessages);

      // 送信済みログの書き込み
      PluginLogService::writeAlreadySendLog($errorLogFile);

      PluginLogService::logFileRotate($errorLogFile);

      $logFileSize = filesize($errorLogFile);

    }
  }
}
