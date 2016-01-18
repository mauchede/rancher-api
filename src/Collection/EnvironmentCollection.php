<?php

namespace Mauchede\RancherApi\Collection;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Resource\Environment;
use Mauchede\RancherApi\Exception\ResourceNotFoundException;

/**
 * Class EnvironmentCollection
 *
 * Represents a Rancher collection typed as "environment".
 *
 * @package Mauchede\RancherApi\Collection
 */
class EnvironmentCollection extends AbstractCollection
{
    /**
     * @var Environment[]
     *
     * @Type("array<Mauchede\RancherApi\Resource\Environment>")
     */
    private $data;

    /**
     * Adds a new environment (aka stack)
     *
     * @param Environment $environment
     * @param bool $startOnCreate
     *
     * @return $this
     */
    public function add(Environment $environment, $startOnCreate = true)
    {
        $this->client->post($this->getUri(), $environment, array('startOnCreate' => $startOnCreate));

        return $this->reload();
    }

    /**
     * {@inheritdoc}
     *
     * @return Environment[]
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     *
     * @return Environment
     */
    public function get($id)
    {
        foreach ($this->data as $host) {
            if ($host->getId() === $id) {
                return $host;
            }
        }

        throw new ResourceNotFoundException(sprintf('Environment "%s" not found.', $id));
    }
}

