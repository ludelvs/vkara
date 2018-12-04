<?php
  define('MARS_ROOT_DIR', 'D:/svn/mars/1.10');
  define('MARS_LIBS_DIR', MARS_ROOT_DIR . '/libs');

  define('APP_PRIVATE_KEY', '33ad62b8f385eb39df2a57d3fd9728edbe1cf364');

  $configDirectory = dirname(__FILE__);

  if (DIRECTORY_SEPARATOR == '\\') {
    $configDirectory = str_replace('\\', '/', $configDirectory);
  }

  $appRootDirectory = substr($configDirectory, 0, strrpos($configDirectory, '/'));

  define('APP_ROOT_DIR', $appRootDirectory);
  define('APP_CACHE_DIR', $appRootDirectory . '/cache');

  require MARS_LIBS_DIR . '/class_loader.php';
