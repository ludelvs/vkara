<?php
  require '../../config/mars_env.php';

  Mars_ClassLoader::initialize();
  Mars_ClassLoader::addSearchPath(MARS_ROOT_DIR . '/webapps/cpanel/libs');
  Mars_Config::resetConfigurations();

  // モジュールディレクトリの設定
  $container = Mars_DIContainerFactory::create();
  Mars_RewriteRouter::getInstance()->entryModuleRegister('cpanel', MARS_ROOT_DIR . '/webapps/cpanel/modules/cpanel');
  $container->componentRegister('controller', array('class' => 'Mars_FrontController'));

  $controller = $container->getController();
  $controller->dispatch();
