<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Exception\HttpException;
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
        $response = $this->app->getResponseFactory()->createResponse();
        $payload = ['errors' => [$exception->getMessage()]];
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );

        if ($exception instanceof HttpException) {
            return $response->withStatus(422);
        }

        return $response->withStatus(500);
    }
}
