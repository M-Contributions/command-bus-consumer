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
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute($command, callable $next)
    {
        $json = \json_encode((array)$command);
        $this->logger->info("Start logging event with data {$json}....\n");

        return $next($command);
    }
}
