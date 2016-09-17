<?php
return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => APP_PATH . '/modules/backend/controllers/',
        'modelsDir'      => __DIR__ . '/../models/',
        'migrationsDir'  => __DIR__ . '/../migrations/',
        'viewsDir'       => APP_PATH . '/modules/backend/views/',
        'baseUri'        => ''
    )
));
