<?php

namespace PurrLib\MaintenanceBundle\Manager;

use PurrLib\MaintenanceBundle\VO\Options;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class MaintenanceManager
{
    const MAINTENANCE_FILE_PATH = '/../var/maintenance.lock';

    /**
     * @var Options
     */
    private $options;

    /**
     * @var string
     */
    private $kernelRoot;

    /**
     * @var string
     */
    private $maintenanceFilePath;
    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * MaintenanceManager constructor.
     * @param $options
     * @param $kernelRoot
     * @param EngineInterface $engine
     */
    public function __construct($options, $kernelRoot, EngineInterface $engine)
    {
        $this->options = new Options($options);
        $this->kernelRoot = $kernelRoot;
        $this->maintenanceFilePath = $kernelRoot . self::MAINTENANCE_FILE_PATH;
        $this->engine = $engine;
    }

    /**
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return array
     */
    public function getAuthorizedIps()
    {
        return $this->options->getAuthorizedIps();
    }

    /**
     * @return bool
     */
    public function enableMaintenance()
    {
        if (!file_exists($this->maintenanceFilePath)) {
            touch($this->maintenanceFilePath);

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function disableMaintenance()
    {
        if (file_exists($this->maintenanceFilePath)) {
            unlink($this->maintenanceFilePath);

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isMaintenanceEnabled()
    {
        return file_exists($this->maintenanceFilePath);
    }

    /**
     * @return string
     */
    public function renderMaintenancePage()
    {
        return $this->engine->render($this->options->getTemplate());
    }
}