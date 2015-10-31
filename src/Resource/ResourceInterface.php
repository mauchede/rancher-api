<?php

namespace Mauchede\RancherApi\Resource;

use Mauchede\RancherApi\Client\ClientAwareInterface;
use Mauchede\RancherApi\Exception\InvalidActionException;

/**
 * Interface ResourceInterface is implemented by all Rancher API resource classes.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
interface ResourceInterface extends ClientAwareInterface
{
    /**
     * Gets the ID.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets the URI.
     *
     * @return string
     *
     * @throws InvalidActionException if the resource does not have URI.
     */
    public function getUri();

    /**
     * Reloads the information.
     *
     * @return $this
     *
     * @throws InvalidActionException if the resource does not have URI.
     */
    public function reload();
}
