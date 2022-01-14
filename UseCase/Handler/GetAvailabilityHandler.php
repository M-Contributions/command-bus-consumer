<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Handler;

use League\Tactician\Middleware;
use Ticaje\Hexagonal\Application\Implementors\Responder\Response;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\HandlerInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

class GetAvailabilityHandler implements Middleware, HandlerInterface
{
    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed|ResponseInterface
     */
    public function execute($command, callable $next)
    {
        $result = $this->handle($command);
        $next($command);

        return $result;
    }

    /**
     * @param UseCaseCommandInterface $command
     *
     * @return ResponseInterface
     */
    public function handle(UseCaseCommandInterface $command): ResponseInterface
    {
        $result = 45;
        $response = (new Response())
            ->setSuccess(true)
            ->setContent($result)
            ->setMessage('Successfully executed...');

        return $response;
    }
}

