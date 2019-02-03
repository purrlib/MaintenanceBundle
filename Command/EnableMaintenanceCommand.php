<?php

namespace PurrLib\MaintenanceBundle\Command;

use PurrLib\MaintenanceBundle\Manager\MaintenanceManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnableMaintenanceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('purrlib:maintenance:enable')
            ->setDescription('Enable maintenance mode')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var MaintenanceManager $maintenanceManager */
        $maintenanceManager = $this->getContainer()->get('purrlib_maintenance.manager');

        if ($maintenanceManager->enableMaintenance()) {
            $output->writeln('The server is under maintenance');
        } else {
            $output->writeln('The server is already under maintenance');
        }
    }
}