<?php

namespace Mauchede\RancherApi\Tests\Resource;

use GuzzleHttp\Psr7\Response;
use Mauchede\RancherApi\Collection\ContainerCollection;
use Mauchede\RancherApi\Resource\Project;
use Mauchede\RancherApi\Tests\RancherApiTestCase;

class ProjectTest extends RancherApiTestCase
{
    public function testDeserialization()
    {
        $client = $this->createClient(array(
            new Response(200, array(), file_get_contents(__DIR__ . '/../Fixtures/project.json')),
            new Response(200, array(), file_get_contents(__DIR__ . '/../Fixtures/container_collection.json')),

        ));

        /** @var Project $project */
        $project = $client->get('http://127.0.0.1:8080/v1/projects/1a5', Project::class);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals('1a5', $project->getId());
        $this->assertEquals('description 1a5', $project->getDescription());
        $this->assertInstanceOf(ContainerCollection::class, $project->getContainers());
    }
}
