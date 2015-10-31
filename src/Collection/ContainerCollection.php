<?php

namespace Mauchede\RancherApi\Collection;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Exception\ResourceNotFoundException;
use Mauchede\RancherApi\Resource\Container;

/**
 * ContainerCollection represents a Rancher collection typed as "container".
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class ContainerCollection extends AbstractCollection
{
    /**
     * @var Container[]
     *
     * @Type("array<Mauchede\RancherApi\Resource\Container>")
     */
    private $data;

    /**
     * Add a new container.
     *
     * @param Container $container
     * @param bool      $startOnCreate
     *
     * @return $this
     */
    public function add(Container $container, $startOnCreate = true)
    {
        $this->client->post($this->getUri(), $container, array('startOnCreate' => $startOnCreate));

        return $this->reload();
    }

    /**
     * {@inheritdoc}
     *
     * @return Container[]
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     *
     * @return Container
     */
    public function get($id)
    {
        foreach ($this->data as $container) {
            if ($container->getId() === $id) {
                return $container;
            }
        }

        throw new ResourceNotFoundException(sprintf('Container "%s" not found.', $id));
    }
}
