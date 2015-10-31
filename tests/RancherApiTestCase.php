<?php

namespace Mauchede\RancherApi\Tests;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Mauchede\RancherApi\Client\Client;

abstract class RancherApiTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Creates a client.
     *
     * @param Response|Response[] $responses
     * @param array               $history
     *
     * @return Client
     */
    protected function createClient($responses = array(), array &$history = array())
    {
        $client = new Client('access', 'secret');
        $client->setHttpClient($this->createHttpClient($responses, $history));

        return $client;
    }

    /**
     * Creates a HTTP client.
     *
     * @param Response|Response[] $responses
     * @param array               $history
     *
     * @return HttpClient
     */
    private function createHttpClient($responses = array(), array &$history = array())
    {
        if (!is_array($responses)) {
            $responses = array($responses);
        }

        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($history));

        return new HttpClient(array(
            'handler' => $stack,
        ));
    }
}
