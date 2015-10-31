<?php

namespace Mauchede\RancherApi\Resource;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use Mauchede\RancherApi\Client\ClientAwareTrait;
use Mauchede\RancherApi\Exception\InvalidActionException;

/**
 * AbstractResource is an abstract implementation of the ResourceInterface.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
abstract class AbstractResource implements ResourceInterface
{
    use ClientAwareTrait;

    /**
     * @var string[]
     *
     * @Type("array<string, string>")
     */
    protected $actions = array();

    /**
     * @var \DateTime
     *
     * @Type("DateTime")
     */
    protected $created;

    /**
     * @var string
     *
     * @Type("string")
     */
    protected $id;

    /**
     * @var string[]
     *
     * @Type("array<string, string>")
     */
    protected $links = array();

    /**
     * @var string
     *
     * @Type("string")
     */
    protected $state;

    /**
     * Gets the created date.
     *
     * @return \DateTime
     *
     * @Type("DateTime")
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the resource type.
     *
     * @VirtualProperty
     * @SerializedName("type")
     *
     * @return string
     */
    abstract public function getType();

    /**
     * {@inheritdoc}
     */
    public function getUri()
    {
        if (!isset($this->links['self'])) {
            throw new InvalidActionException('Impossible to retrieve the URI.');
        }

        return $this->links['self'];
    }

    /**
     * {@inheritdoc}
     */
    public function reload()
    {
        return $this->client->get($this->getUri(), static::class);
    }
}
