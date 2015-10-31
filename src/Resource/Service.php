<?php

namespace Mauchede\RancherApi\Resource;

use JMS\Serializer\Annotation\Type;

/**
 * Service represents a Rancher resource typed as "service".
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class Service extends AbstractResource
{
    /**
     * @var string
     *
     * @Type("string")
     */
    private $name;

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
        return 'service';
    }
}
