<?php

namespace PreserveMyGames\Altcha\Api\Controller;

use Laminas\Diactoros\Response\JsonResponse;
use PreserveMyGames\Altcha\Service\AltchaService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ChallengeController implements RequestHandlerInterface
{
    public function __construct(
        private AltchaService $altcha
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (! $this->altcha->isConfigured()) {
            return new JsonResponse(['error' => 'ALTCHA is not configured'], 503);
        }

        return new JsonResponse($this->altcha->createChallenge());
    }
}
