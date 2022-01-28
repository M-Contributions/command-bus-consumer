<?php
declare(strict_types=1);
/**
 * Decorator Module
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Middleware;

use League\Tactician\Middleware;
use Psr\Log\LoggerInterface;
use Ticaje\Hexagonal\Application\Signatures\Responder\ResponseInterface;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

class LoggerMiddleware implements Middleware
{
    use MiddlewareTrait;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LoggerMiddleware constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

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
     * This method is just an approach to logging business logic
     * @param UseCaseCommandInterface $command
     */
    private function preLogic(UseCaseCommandInterface $command)
    {
        $json = \json_encode((array)$command);
        $logMessage = "Logging pre event with data {$json}....\n";
        $this->logger->info($logMessage);
    }

    /**
     * This method is just an approach to logging business logic
     * @param ResponseInterface $response
     */
    private function postLogic(ResponseInterface $response)
    {
        $json = \json_encode((array)$response->getContent());
        $this->logger->info($json);
        $response->getSuccess() ? $this->runSuccess($response, (function (ResponseInterface $response) {
            $logMessage = "Logging success post event, message: {$response->getMessage()}....\n";
            $this->logger->info($logMessage);
        })) : $this->runFailure($response, (function (ResponseInterface $response) {
            $logMessage = "Logging failure post event, message:  {$response->getMessage()}....\n";
            $this->logger->info($logMessage);
        }));
    }
}
