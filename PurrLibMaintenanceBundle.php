<?php

namespace PurrLib\MaintenanceBundle;

use PurrLib\MaintenanceBundle\DependencyInjection\PurrLibMaintenanceExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PurrLibMaintenanceBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new PurrLibMaintenanceExtension();
    }
}
