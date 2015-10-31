<?php

namespace Mauchede\RancherApi\Collection;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Resource\Service;
use Rancher\Exception\ResourceNotFoundException;

/**
 * ServiceCollection represents a Rancher collection typed as "service".
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class ServiceCollection extends AbstractCollection
{
    /**
     * @var Service[]
     *
     * @Type("array<Mauchede\RancherApi\Resource\Service>")
     */
    private $data;

    /**
     * {@inheritdoc}
     *
     * @return Service[]
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     *
     * @return Service
     */
    public function get($id)
    {
        foreach ($this->data as $host) {
            if ($host->getId() === $id) {
                return $host;
            }
        }

        throw new ResourceNotFoundException(sprintf('Service "%s" not found.', $id));
    }
}
