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
     * @var string
     *
     * @Type("string")
     */
    private $dockerCompose;

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

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $name;
    }

    public function setDockerComposer($dockerCompose)
    {
        $this->dockerCompose = $dockerCompose;

        return $this;
    }

}
