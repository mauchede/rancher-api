<?php

namespace Mauchede\RancherApi\Exception;

/**
 * ResourceNotFoundException is thrown when a resource does not exist.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class ResourceNotFoundException extends \RuntimeException implements RancherApiException
{
}
