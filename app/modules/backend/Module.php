<?php

namespace Webxucxich\Modules\Backend;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config;
use Phalcon\Mvc\Dispatcher;

class Multi implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Webxucxich\Modules\Backend\Controllers' => __DIR__ . '/controllers/',
            'Webxucxich\Modules\Modeldb\Models' => '../app/modules/modeldb/models/',
            'Webxucxich\Common\Library' => '../app/common/library/'
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {

        $di['view'] = function () {
            //$config = $this->getConfig();
            $config = include APP_PATH . "/modules/backend/config/config.php";
            $view = new View();
            $view->setViewsDir($config->get('application')->viewsDir);

            return $view;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        /*$di['db'] = function () {
            $config = $this->getConfig();

            $dbConfig = $config->database->toArray();

            $dbAdapter = '\Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            unset($config['adapter']);

            return new $dbAdapter($dbConfig);
        };*/
    }
}
