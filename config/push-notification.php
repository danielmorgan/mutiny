<?php

return array(
    'test' => array(
        'environment' => env('APP_ENV', 'production'),
        'apiKey'      => env('GCM_SENDER_ID'),
        'service'     => 'gcm'
    )
);
