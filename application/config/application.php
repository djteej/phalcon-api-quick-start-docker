<?php
return new Phalcon\Config([
    'application' => [
        'controllerPath'  => APP_PATH . '/controller/',
        'modelPath'       => APP_PATH . '/model/',
        'validationPath'  => APP_PATH . '/validation/',
        'logPath'         => BASE_PATH . '/log/',
    ]
]);
