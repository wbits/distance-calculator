<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Throwable;

final class ErrorHandler
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
    public function __invoke(
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ) {
        $payload = ['errors' => [$exception->getMessage()]];
        $response = $this->app->getResponseFactory()->createResponse();
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );
        return $response->withStatus(422);
    }
}

