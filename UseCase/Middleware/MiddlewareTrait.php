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
}
