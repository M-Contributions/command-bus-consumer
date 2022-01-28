<?php
declare(strict_types=1);
/**
 * Trait Module
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Middleware;

use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

trait MiddlewareTrait
{
    /**
     * @param $command
     */
    private function logic($command)
    {
        $this->discriminateOrder($command);
    }

    /**
     * @param $command
     */
    private function discriminateOrder($command)
    {
        if ($command instanceof UseCaseCommandInterface) {
            $this->preLogic($command);
        }
        if ($command instanceof ResponseInterface) {
            $this->postLogic($command);
        }
    }

    /**
     * @param ResponseInterface $response
     * @param callable          $logic
     */
    private function runSuccess(ResponseInterface $response, callable $logic)
    {
        $logic($response);
    }

    /**
     * @param ResponseInterface $response
     * @param callable          $logic
     */
    private function runFailure(ResponseInterface $response, callable $logic)
    {
        $logic($response);
    }
}
