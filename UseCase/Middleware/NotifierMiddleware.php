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
    public function execute($command, callable $next)
    {
        // Send notification logic...

        return $next($command);
    }
}
