<?php
declare(strict_types=1);

namespace Ticaje\CommandBus\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ticaje\CommandBus\UseCase\Command\ReaderCommand;
use Ticaje\CommandBus\UseCase\Command\ReaderCommandFactory;
use Ticaje\Hexagonal\Application\Signatures\UseCase\BusFacadeInterface;

class Reader extends Command
{
    /** @var InputInterface */
    private $input;

    private $bus;

    private $commandFactory;

    public function __construct(
        BusFacadeInterface $bus,
        ReaderCommandFactory $commandFactory,
        string $name = null
    ) {
        $this->bus = $bus;
        $this->commandFactory = $commandFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName("ticaje:command:reader");
        $this->setDescription("Execute some Command");
        $arguments = [
            new InputOption('store', null, InputOption::VALUE_REQUIRED, 'Store ID'),
            new InputOption('email', null, InputOption::VALUE_OPTIONAL, 'Email'),
        ];
        $this->setDefinition($arguments);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        if (!$this->input->getOption('store')) {
            $output->writeln('Please pass store ID off');
        } else {
            $output->writeln("Launching Logic ...");
            $this->launch($output);
        }
    }

    /**
     * @param OutputInterface $output
     */
    private function launch(OutputInterface $output)
    {
        $store = (int)$this->input->getOption('store');
        $email = $this->input->getOption('email') ?? '';
        /** @var ReaderCommand $command */
        $command = $this->commandFactory->create();
        $command
            ->setStoreId($store)
            ->setEmail($email);
        $result = $this->bus->execute($command);
        print_r($result);
        $output->writeln("End Launch ...");
    }
}
