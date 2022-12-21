<?php
ini_set('display_errors', true);
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Main_Database.php';

use GO\Scheduler;

$scheduler = new Scheduler();

$scheduler->call(function () {
    $database = new Main_Database();
    $database->importData(__DIR__ . '/products.csv');
})->everyMinute(2);


$scheduler->run();