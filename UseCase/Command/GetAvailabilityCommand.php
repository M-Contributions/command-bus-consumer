<?php
declare(strict_types=1);
/**
 * DTO class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\UseCase\Command;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class ReaderCommand
 * @package Ticaje\CommandBus\UseCase\Command
 */
class GetAvailabilityCommand implements UseCaseCommandInterface
{
    const DEFAULT_ID_VALUE = 5;

    private $storeId;

    private $email;

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->storeId ?? self::DEFAULT_ID_VALUE;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setStoreId(int $value)
    {
        $this->storeId = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setEmail(string $value)
    {
        $this->email = $value;

        return $this;
    }
}
