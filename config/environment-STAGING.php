<?php
// Config: Environment sepecific config settings.

return array(
    'logging_level' => Monolog\Logger::DEBUG,			// Which level to log to the logger.
    'logs_dir' => __DIR__.'/../../shared/logs/app.log',
    'webroot' => '/'
);
