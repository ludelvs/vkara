<?php
require '../config/mars_env.php';

Mars_ClassLoader::initialize();

$attributes = array();
$attributes['class'] = 'Mars_FrontController';
$attributes['path'] =  MARS_LIBS_DIR . '/controller/Mars_FrontController.class.php';

$container = Mars_DIContainerFactory::create();
$container->componentRegister('controller', $attributes);

$controller = $container->getController();
$controller->dispatch();
