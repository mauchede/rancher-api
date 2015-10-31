<?php

namespace Mauchede\RancherApi\Client;

/**
 * Trait ClientAwareTrait is used by classes that implements ClientAwareInterface.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
trait ClientAwareTrait
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Sets the Client.
     *
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}
