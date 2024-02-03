<?php

declare(strict_types=1);

use Illumineer\Application;
use Illumineer\Stdlib\Request;
use Swoole\Http\Server as SwooleServer;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;

require __DIR__ . '/vendor/autoload.php';

/** @var Application $application */
$application = require __DIR__ . '/bootstrap.php';

$swooleServer = new SwooleServer('0.0.0.0', 9501, SWOOLE_PROCESS);

$swooleServer->set([
    'worker_num' => 8,
    'task_worker_num' => 4,
    'document_root' => __DIR__ . '/public',
    'enable_static_handler' => true,
]);

$swooleServer->on('Start', function (): void {
    echo 'Swoole http server is started at http://127.0.0.1:9501' . PHP_EOL;
});

$swooleServer->on('Request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) use ($application): void {
    $application->handleRequest(Request::fromSwoole($swooleRequest))->send($swooleResponse);
});

$swooleServer->on('Task', function (SwooleServer $swooleServer, int $taskId, int $reactorId, mixed $data) use ($application) {
    $application->handleTask($data);
});

$swooleServer->start();
