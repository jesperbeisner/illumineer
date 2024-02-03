<?php

declare(strict_types=1);

namespace Illumineer\Stdlib;

use Swoole\Http\Response as SwooleResponse;

final readonly class Response
{
    public const string CONTENT_TYPE_HTML = 'text/html; charset=utf-8';

    public function __construct(
        public int $status,
        public string $contentType,
        public string $content,
        public string $location,
    ) {
    }

    public static function html(string $template, array $vars = [], int $status = 200): Response
    {
        return new Response($status, self::CONTENT_TYPE_HTML, 'Hello World', '');
    }

    public function send(SwooleResponse $swooleResponse): void
    {
        $swooleResponse->status($this->status);
        $swooleResponse->header('Content-Type', $this->contentType);

        $swooleResponse->end($this->content);
    }
}
