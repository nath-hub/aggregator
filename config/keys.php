<?php
 
return [
     
      'services' => [
        'user' => env('USER_INTERFACE'),
        'apikeys' => env('APIKEYS_INTERFACE'), 
        'transactions' => env('TRANSACTION_INTERFACE'),
        'notifications' => env('NOTIFICATION_INTERFACE')
    ],
];
