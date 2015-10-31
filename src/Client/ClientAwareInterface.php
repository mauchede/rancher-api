<?php

namespace Mauchede\RancherApi\Client;

/**
 * Interface ClientAwareInterface is implemented by classes that depends on a Client.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
interface ClientAwareInterface
{
    /**
     * Sets the Client.
     *
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client);
}
