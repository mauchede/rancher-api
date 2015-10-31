<?php

namespace Mauchede\RancherApi\Tests\Client;

use GuzzleHttp\Psr7\Response;
use Mauchede\RancherApi\Exception\InvalidAuthenticationInformationException;
use Mauchede\RancherApi\Tests\Fixtures\ClientAwareStub;
use Mauchede\RancherApi\Tests\Fixtures\Stub;
use Mauchede\RancherApi\Tests\RancherApiTestCase;

class ClientTest extends RancherApiTestCase
{
    /**
     * Tests the client with invalid credentials.
     */
    public function testInvalidCredentials()
    {
        $client = $this->createClient(new Response(401));

        $this->setExpectedException(InvalidAuthenticationInformationException::class, 'Authentication information is invalid.');
        $client->get('127.0.0.1:8080/stub/1a5', Stub::class);
    }

    /**
     * Tests a GET request with a plain old class.
     */
    public function testGetWithClass()
    {
        $json = file_get_contents(__DIR__ . '/../Fixtures/stub.json');
        $client = $this->createClient(new Response(200, array(), $json));

        $stub = $client->get('127.0.0.1:8080/stub/1a5', Stub::class);

        $this->assertInstanceOf(Stub::class, $stub);
        $this->assertEquals('1a5', $stub->getId());
        $this->assertEquals('external', $stub->getExternalUuid());
    }

    /**
     * Tests a GET request with a "client aware" class.
     */
    public function testGetWithClientAwareClass()
    {
        $json = file_get_contents(__DIR__ . '/../Fixtures/stub.json');
        $client = $this->createClient(new Response(200, array(), $json));

        $stub = $client->get('127.0.0.1:8080/stub/1a5', ClientAwareStub::class);

        $this->assertInstanceOf(ClientAwareStub::class, $stub);
        $this->assertEquals('1a5', $stub->getId());
        $this->assertEquals('external', $stub->getExternalUuid());
        $this->assertEquals($client, $stub->getClient());
    }

    /**
     * Tests a POST request with an array as data.
     */
    public function testPostWithArray()
    {
        $history = array();
        $client = $this->createClient(new Response(201), $history);

        $client->post('http://127.0.0.1:8080/v1/stubs', array('foo' => 'foo'), array('bar' => 'bar'));

        $request = $history[0]['request'];
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('http://127.0.0.1:8080/v1/stubs', $request->getUri());
        $this->assertEquals('{"foo":"foo","bar":"bar"}', (string)$request->getBody());
    }
}
