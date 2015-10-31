<?php

namespace Mauchede\RancherApi\Tests\Fixtures;

use JMS\Serializer\Annotation\Type;

class Stub
{
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
