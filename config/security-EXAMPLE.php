<?php

// Config: Private/secret un-versioned configuration.
// DO NOT CHECK INTO SOURCE CONTROL.

return array(

    'database' => [								// Database settings.
        'engine' => 'mysqli',
        'host' => 'localhost',
        'port' => '',
        'name' => 'database_name',
        'user' => 'db1user1',
        'password' => 'password'
    ],
    'keys' => [
        'google_api_key' => 'XXXXXXXXXXXXXXXX'		// API Key for Google - maps, etc.
    ]
);
