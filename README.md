# Rancher API

Rancher API is a set of PHP classes for interacting with [Rancher](http://rancher.com/rancher/).

⚠️ This project is no longer maintained. ⚠️

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1f7de942-8900-4f1b-8840-013d2e62b8bc/big.png)](https://insight.sensiolabs.com/projects/1f7de942-8900-4f1b-8840-013d2e62b8bc)

## Installation

Rancher API can be installed via [composer](https://getcomposer.org/):

```bash
composer require mauchede/rancher-api
```

__Note__: To use the JMS annotation, you may have to configure your `autoload`. You can find an example in [bootstrap.php.dist](https://github.com/mauchede/rancher-api/blob/master/bootstrap.php.dist).

## Usage

```php
use Mauchede\RancherApi\Client\Client;
use Mauchede\RancherApi\Resource\Project;

$client = new Client('access_key', 'secret_key');
$project = $client->get('endpoint', Project::class);
$containers = $project->getContainers();
```

`endpoint` and the API Keys (`access_key` and `secret_key`) can be found in Rancher settings (`[Rancher URL]/settings/api`).

__Note__: API keys are only available for ***one*** project/environment.

## Links

* [Guzzle documentation](https://guzzle.readthedocs.org/)
* [JMS Serializer documentation](http://jmsyst.com/libs/serializer)
* [Specification for Rancher REST API implementation](https://github.com/rancher/api-spec)
