<?php

namespace Mauchede\RancherApi\Resource;

use JMS\Serializer\Annotation\Type;

/**
 * Class Environment
 *
 * Represents the rancher resource typed as "environment".
 *
 * @package Mauchede\RancherApi\Resource
 */
class Environment extends AbstractResource
{
    /**
     * @var string
     *
     * @Type("string")
     */
    private $description;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $name;

    /**
     * Gets the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'environment';
    }
}
