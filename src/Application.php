<?php

declare(strict_types=1);

namespace Illumineer;

use Illumineer\Stdlib\Request;
use Illumineer\Stdlib\Response;

final readonly class Application
{
    public function handleRequest(Request $request): Response
    {
        return Response::html('test');
    }

    public function handleTask(mixed $data): void
    {
        // TODO: Handle task
    }
}
