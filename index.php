<?php

use App\App;
use App\Client\ApiClient;
use App\Client\StorageClient;
use App\Service\StatisticService;
use Dotenv\Dotenv;

require './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    run();
} catch (Exception $exception) {
    // log, show or hide message depends om env...
    die($exception->getMessage());
}

function run()
{
    $result = (new App(
        new StorageClient(),
        new ApiClient(),
        new StatisticService()
    ))->run();

    die($result);
}


