<?php

namespace Mauchede\RancherApi\Exception;

/**
 * InvalidActionException is thrown when an action does not exist.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class InvalidActionException extends \RuntimeException implements RancherApiException
{
}
