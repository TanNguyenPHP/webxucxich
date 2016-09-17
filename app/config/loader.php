<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Webxucxich\Models' => APP_PATH . '/common/models/',
    'Webxucxich' => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Webxucxich\Modules\Frontend\Multi' => APP_PATH . '/modules/frontend/Module.php',
    'Webxucxich\Modules\Backend\Multi' => APP_PATH . '/modules/backend/Module.php',
    'Webxucxich\Modules\Cli\Multi' => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
