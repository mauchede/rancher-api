<?php

namespace Mauchede\RancherApi\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\ClientException;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GenericSerializationVisitor;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Mauchede\RancherApi\Exception\BadResponseException;
use Mauchede\RancherApi\Exception\InvalidAuthenticationInformationException;
use Mauchede\RancherApi\Exception\ResourceNotFoundException;
use Psr\Http\Message\ResponseInterface;

/**
 * Client for sending requests to the Rancher API.
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class Client implements ClientInterface
{
    /**
     * @var string
     */
    private $accessKey;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Constructor.
     *
     * @param string $accessKey
     * @param string $secretKey
     */
    public function __construct($accessKey, $secretKey)
    {
        $this->httpClient = new HttpClient();
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;

        $this->serializer = $this->createSerializer();
    }

    /**
     * {@inheritdoc}
     */
    public function get($uri, $class)
    {
        try {
            return $this->serializer->deserialize($this->request('GET', $uri)->getBody(), $class, 'json');
        } catch (ClientException $exception) {
            switch ($exception->getCode()) {
                case 401:
                    throw new InvalidAuthenticationInformationException('Authentication information is invalid.');

                case 404:
                    throw new ResourceNotFoundException(sprintf('Resource "%s" not found.', $uri), 404, $exception);

                default:
                    throw new BadResponseException($exception->getMessage(), $exception->getCode(), $exception);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, $data = null, array $options = array())
    {
        if (is_array($data)) {
            $options = array_merge($data, $options);
            $data = new \StdClass();
        }

        $this->request('post', $uri, array(
            'body' => $this->serializer->serialize($data, 'json', SerializationContext::create()->setAttribute('options', $options))
        ));
    }

    /**
     * @param HttpClientInterface $httpClient
     *
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Creates a serializer.
     *
     * @return SerializerInterface
     */
    private function createSerializer()
    {
        return SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->configureListeners(function (EventDispatcher $dispatcher) {
                $dispatcher->addListener('serializer.post_deserialize',
                    function (ObjectEvent $event) {
                        $object = $event->getObject();
                        if ($object instanceof ClientAwareInterface) {
                            $object->setClient($this);
                        }
                    }
                );

                $dispatcher->addListener('serializer.post_serialize',
                    function (ObjectEvent $event) {
                        $options = $event->getContext()->attributes->get('options')->getOrElse(array());
                        $visitor = $event->getVisitor();

                        if ($visitor instanceof GenericSerializationVisitor) {
                            foreach ($options as $key => $value) {
                                $visitor->addData($key, $value);
                            }
                        }
                    }
                );
            })
            ->build();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return ResponseInterface
     */
    private function request($method, $uri, array $options = array())
    {
        $options['auth'] = array($this->accessKey, $this->secretKey);

        return $this->httpClient->request($method, $uri, $options);
    }
}
