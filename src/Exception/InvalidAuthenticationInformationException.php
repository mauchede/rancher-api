<?php

namespace Mauchede\RancherApi\Exception;

/**
 * InvalidAuthenticationInformationException is thrown when the API credentials ("access key" and "secret key") are invalids.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class InvalidAuthenticationInformationException extends BadResponseException implements RancherApiException
{
}
