<?php
require_once('secret.php');
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname='. $DB_NAME,
    'username' => $DB_USERNAME,
    'password' => $DB_PASSWORD,
    'charset' => 'utf8',
];
