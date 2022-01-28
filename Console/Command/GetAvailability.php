<?php
declare(strict_types=1);
/**
 * Console Command Class
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\CommandBus\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ticaje\CommandBus\UseCase\Command\GetAvailabilityCommand;
use Ticaje\Hexagonal\Application\Signatures\UseCase\BusFacadeInterface;

class GetAvailability extends Command
{
    /** @var InputInterface */
    private $input;

    private $bus;

    public function __construct(
        BusFacadeInterface $bus,
        string $name = null
    ) {
        $this->bus = $bus;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName("ticaje:command:availability");
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
        $output->writeln("Launching Logic ...");
        $this->launch();
        $output->writeln("End Launch ...");
    }

    private function launch()
    {
        /** @var ReaderCommand $command */
        $command = new GetAvailabilityCommand();
        $result = $this->bus->execute($command);
        print_r($result);
    }
}
