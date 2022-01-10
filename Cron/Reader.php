<?php
declare(strict_types=1);

namespace Ticaje\CommandBus\Cron;

use Magento\Store\Model\StoreManagerInterface;
use Ticaje\CommandBus\UseCase\Command\ReaderCommand;
use Ticaje\CommandBus\UseCase\Command\ReaderCommandFactory;
use Ticaje\Hexagonal\Application\Signatures\UseCase\BusFacadeInterface;

class Reader
{
    private $bus;

    private $commandFactory;

    private $storeManager;

    public function __construct(
        BusFacadeInterface $bus,
        ReaderCommandFactory $commandFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->bus = $bus;
        $this->commandFactory = $commandFactory;
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
    }
}
