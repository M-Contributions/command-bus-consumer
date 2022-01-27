<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Middleware;

use League\Tactician\Middleware;
use Psr\Log\LoggerInterface;

class LoggerMiddleware implements Middleware
{
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
        // Logging logic...
        $this->logic($command);

        return $next($command);
    }

    /**
     * @param $command
     */
    private function logic($command)
    {
        $json = \json_encode((array)$command);
        $logMessage = "Start logging event with data {$json}....\n";
        $this->logger->info($logMessage);
        echo $logMessage;
    }
}
