<?php

namespace Mauchede\RancherApi\Resource;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Exception\InvalidActionException;

/**
 * Host represents a Rancher resource typed as "host".
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class Host extends AbstractResource
{
    /**
     * @var string
     *
     * @Type("string")
     */
    private $description;

    /**
     * @var array
     *
     * @Type("array")
     */
    private $info;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $name;

    /**
     * Deactivates a container.
     *
     * @throws InvalidActionException if the host can not be deactivate.
     */
    public function deactivate()
    {
        if (!isset($this->actions['deactivate'])) {
            throw new InvalidActionException(sprintf('Impossible to deactivate the host "%s" (current state "%s").', $this->id, $this->state));
        }

        $this->client->post($this->actions['deactivate']);
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
     * Get the information.
     *
     * @return array
     */
    public function getInfo()
    {
        return $this->info;
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
        return 'host';
    }
}
