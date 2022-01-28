<?php
declare(strict_types=1);
/**
 * Cron Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\Cron;

use Magento\Store\Model\StoreManagerInterface;
use Ticaje\CommandBus\UseCase\Command\ReaderCommand;
use Ticaje\CommandBus\UseCase\Command\ReaderCommandFactory;
use Ticaje\CommandBus\UseCase\Command\GetAvailabilityCommandFactory;
use Ticaje\Hexagonal\Application\Signatures\UseCase\BusFacadeInterface;

class Reader
{
    private $bus;

    private $commandFactory;

    private $getAvailabilityCommandFactory;

    private $storeManager;

    public function __construct(
        BusFacadeInterface $bus,
        ReaderCommandFactory $commandFactory,
        GetAvailabilityCommandFactory $availabilityCommandFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->bus = $bus;
        $this->commandFactory = $commandFactory;
        $this->getAvailabilityCommandFactory = $availabilityCommandFactory;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        $this->decoratorBasedImplementation();
    }

    private function decoratorBasedImplementation()
    {
        $store = (int)$this->storeManager->getStore()->getId();
        $email = 'max@gmail.com';
        /** @var ReaderCommand $command */
        $command = $this->commandFactory->create();
        $command
            ->setStoreId($store)
            ->setEmail($email);
        $result = $this->bus->execute($command);
        print_r($result);

        $commandGetAvailability = $this->getAvailabilityCommandFactory->create();
        $commandGetAvailability
            ->setStoreId($store)
            ->setEmail($email);
        $result = $this->bus->execute($commandGetAvailability);
        print_r($result);


    }
}
