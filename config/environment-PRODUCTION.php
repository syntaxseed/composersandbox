<?php

// Config: Environment sepecific config settings.

return array(
    'env' => [
        'logging_level' => Monolog\Logger::DEBUG,			// Which level to log to the logger.
        'log_file' => __DIR__.'/../../../shared/logs/app.log',
        'webroot' => '/'
    ]
);
