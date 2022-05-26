<?php

$config = [
    'host' => 'localhost',
    'port' => '8123',
    'username' => 'default',
    'password' => '12345'
];
        
$db = new \ClickHouseDB\Client($config);