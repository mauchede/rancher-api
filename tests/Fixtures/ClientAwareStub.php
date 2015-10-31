<?php

namespace Mauchede\RancherApi\Tests\Fixtures;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Client\ClientAwareInterface;
use Mauchede\RancherApi\Client\ClientAwareTrait;
use Mauchede\RancherApi\Client\ClientInterface;

class ClientAwareStub implements ClientAwareInterface
{
    use ClientAwareTrait;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $externalUuid;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $id;

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getExternalUuid()
    {
        return $this->externalUuid;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
