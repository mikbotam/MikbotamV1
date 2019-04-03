<?php

require_once 'system.medoo.php';

$mikbotamdata = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'mikbotam',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'admin12345',
    'charset' => 'utf8'
]);
