<?php

namespace PurrLib\MaintenanceBundle\VO;

use PurrLib\MaintenanceBundle\Utils\Camelizer;

class Options
{
    /**
     * @var array
     */
    private $authorizedIps;

    /**
     * @var string
     */
    private $template;

    /**
     * Options constructor.
     * @param $options
     */
    public function __construct($options)
    {
        foreach($options as $key => $value) {
            /** @var string $property */
            $property = lcfirst(Camelizer::camelize($key));
            $this->{$property} = $value;
        }
    }

    /**
     * @return array
     */
    public function getAuthorizedIps()
    {
        return $this->authorizedIps;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}