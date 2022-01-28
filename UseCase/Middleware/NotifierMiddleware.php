<?php
declare(strict_types=1);
/**
 * Decorator Module
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Middleware;

use League\Tactician\Middleware;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

class NotifierMiddleware implements Middleware
{
    use MiddlewareTrait;

    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $this->logic($command);

        return $next($command);
    }

    /**
     * This method has no implementation cause is left to be filled in by stakeholders.
     * @param UseCaseCommandInterface $command
     */
    private function preLogic(UseCaseCommandInterface $command)
    {
        $message = "Sending pre notification...\n";
    }

    /**
     * This method has no implementation cause is left to be filled in by stakeholders.
     * @param ResponseInterface $response
     */
    private function postLogic(ResponseInterface $response)
    {
        $response->getSuccess() ? $this->runSuccess($response, (function (ResponseInterface $response) {
            $message = "Sending success post notification, message: {$response->getMessage()} \n";
            $content = "Sending success post notification, content: {$response->getContent()} \n";
        })) : $this->runFailure($response, (function (ResponseInterface $response) {
            $message = "Sending failure post notification, message: {$response->getMessage()} \n";
        }));
    }
}
