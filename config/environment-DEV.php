<?php
// Config: Environment sepecific config settings.

return array(
    'logging_level' => Monolog\Logger::DEBUG,			// Which level to log to the logger.
    'webroot' => '/',
    'logs_dir' => __DIR__.'/../logs/app.log'
);
