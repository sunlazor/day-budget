<?php

declare(strict_types=1);

namespace Runner;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Application implements RequestHandlerInterface
{
    #[\Override] public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(body: "Hello, world!");
    }
}