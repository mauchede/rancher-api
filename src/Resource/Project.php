<?php

namespace Mauchede\RancherApi\Resource;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Collection\ContainerCollection;
use Mauchede\RancherApi\Collection\HostCollection;
use Mauchede\RancherApi\Collection\ServiceCollection;
use Mauchede\RancherApi\Collection\EnvironmentCollection;

/**
 * Project represents a Rancher resource typed as "project".
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class Project extends AbstractResource
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
     * Gets the containers.
     *
     * @return ContainerCollection
     */
    public function getContainers()
    {
        return $this->client->get($this->links['containers'], ContainerCollection::class);
    }

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
     * Gets the hosts.
     *
     * @return HostCollection
     */
    public function getHosts()
    {
        return $this->client->get($this->links['hosts'], HostCollection::class);
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
     * Gets the services.
     *
     * @return ServiceCollection
     */
    public function getServices()
    {
        return $this->client->get($this->links['services'], ServiceCollection::class);
    }

    /**
     * Gets the environments.
     *
     * @return EnvironmentCollection
     */
    public function getEnvironments()
    {
        return $this->client->get($this->links['environments'], EnvironmentCollection::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'project';
    }
}
