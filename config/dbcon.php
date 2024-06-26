<?php

require __DIR__.'./../vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount(__DIR__.'/firebase_credentials.json') 
    ->withDatabaseUri('https://online-store-5c7dd-default-rtdb.europe-west1.firebasedatabase.app/');

    $database = $factory->createDatabase();
    $auth = $factory->createAuth();
?>