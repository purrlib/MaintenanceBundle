<?php

namespace PurrLib\MaintenanceBundle\Command;

use PurrLib\MaintenanceBundle\Manager\MaintenanceManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisableMaintenanceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('purrlib:maintenance:disable')
            ->setDescription('Disable maintenance mode')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var MaintenanceManager $maintenanceManager */
        $maintenanceManager = $this->getContainer()->get('purrlib_maintenance.manager');

        if ($maintenanceManager->disableMaintenance()) {
            $output->writeln('The server is online');
        } else {
            $output->writeln('The server is already online');
        }
    }
}