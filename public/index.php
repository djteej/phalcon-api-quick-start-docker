<?php
error_reporting(E_ALL);

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__DIR__)));
defined('APP_PATH') || define('APP_PATH', getenv('APP_PATH') ?: BASE_PATH . '/application');

try {
    $config = new Phalcon\Config();

    foreach (glob(APP_PATH . "/config/*.php") as $filename) {
        $config->merge(require_once $filename);
    }

    $di = new Phalcon\Di\FactoryDefault();
    $di->setShared('config', $config);
    $di->set(
        'db',
        function () use ($di) {
            return new Phalcon\Db\Adapter\Pdo\Mysql(
                $di->getShared('config')->database->toArray()
            );
        }
    );

    $loader = new Phalcon\Loader();
    $loader->registerDirs(
        [
            $di->getShared('config')->application->controllerPath,
            $di->getShared('config')->application->modelPath,
            $di->getShared('config')->application->validationPath,
        ]
    )->register();

    $test = new Phalcon\Mvc\Micro\Collection();
    $test->setHandler('TestController', true);
    $test->get('/', 'get');
    $test->post('/', 'post');

    $application = new Phalcon\Mvc\Micro($di);
    $application->error(['ErrorController', 'error']);
    $application->notFound(['ErrorController', 'notFound']);
    $application->mount($test);
    $application->handle();

} catch (Exception $e) {

    error_log($e->getMessage());
    error_log($e->getTraceAsString());
}
