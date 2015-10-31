<?php

namespace Mauchede\RancherApi\Exception;

/**
 * ColumnNotFoundException is thrown when a column does not exist.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class ColumnNotFoundException extends \RuntimeException implements RancherApiException
{
}
