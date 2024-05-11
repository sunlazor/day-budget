<?php

require __DIR__ . '/../vendor/autoload.php';

// initialize the Application kernel
$app = new \Runner\Application();

// create Request object
$worker = \Spiral\RoadRunner\Worker::create();
$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
$creator = new \Spiral\RoadRunner\Http\PSR7Worker($worker, $psr17Factory, $psr17Factory, $psr17Factory);

while ($request = $creator->waitRequest()) {
    // pass the Request object to the Application kernel
    $response = $app->handle($request);

    // emit Response
    $creator->respond($response);
}
