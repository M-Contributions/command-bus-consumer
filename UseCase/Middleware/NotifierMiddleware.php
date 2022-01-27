<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Middleware;

use League\Tactician\Middleware;

class NotifierMiddleware implements Middleware
{
    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        // Send notification logic...
        $this->logic($command);

        return $next($command);
    }

    /**
     * @param $command
     */
    private function logic($command)
    {
        // Implementation goes here
        echo "Sending notification...\n";
    }
}
