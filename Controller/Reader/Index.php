<?php
declare(strict_types=1);

namespace Ticaje\CommandBus\Controller\Reader;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Store\Model\StoreManagerInterface;
use Ticaje\CommandBus\UseCase\Command\ReaderCommand;
use Ticaje\CommandBus\UseCase\Command\ReaderCommandFactory;
use Ticaje\Hexagonal\Application\Signatures\UseCase\BusFacadeInterface;

class Index extends Action
{
    const DEFAULT_EMAIL = 'max@gmail.com';

    private $result;

    private $storeManager;

    private $bus;

    private $commandFactory;

    public function __construct(
        JsonFactory $resultJsonFactory,
        StoreManagerInterface $storeManager,
        BusFacadeInterface $bus,
        ReaderCommandFactory $commandFactory,
        Context $context
    ) {
        parent::__construct($context);
        $this->bus = $bus;
        $this->commandFactory = $commandFactory;
        $this->storeManager = $storeManager;
        $this->result = $resultJsonFactory;
    }

    public function execute()
    {
        $resultJson = $this->result->create();
        $data = $this->logic();

        return $resultJson->setData($data);
    }

    private function logic()
    {
        $store = (int)$this->storeManager->getStore()->getId();
        $defaultEmail = self::DEFAULT_EMAIL;
        $email = $this->getRequest()->getParam('email') ?? $defaultEmail;
        /** @var ReaderCommand $command */
        $command = $this->commandFactory->create();
        $command
            ->setStoreId($store)
            ->setEmail($email);
        $result = $this->bus->execute($command);

        return (array)$result;
    }
}
