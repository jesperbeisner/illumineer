<?php

declare(strict_types=1);

namespace Illumineer\Stdlib;

use Swoole\Http\Request as SwooleRequest;

final class Request
{
    public function __construct()
    {
    }

    public static function fromSwoole(SwooleRequest $swooleRequest): Request
    {
        return new Request();
    }
}
