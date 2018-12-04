<?php
  $batchPath = dirname(__FILE__);
  $basePath = substr($batchPath, 0, strrpos($batchPath, DIRECTORY_SEPARATOR));

  require $basePath . '/config/mars_env.php';

  Mars_ClassLoader::initialize();

  $attributes = array();
  $attributes['class'] = 'Mars_ConsoleController';
  $attributes['path'] = MARS_LIBS_DIR . '/controller/Mars_ConsoleController.class.php';

  $container = Mars_DIContainerFactory::create();
  $container->componentRegister('controller', $attributes);

  $controller = $container->getController();
  $controller->dispatch();
