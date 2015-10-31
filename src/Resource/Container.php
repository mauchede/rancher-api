<?php

namespace Mauchede\RancherApi\Resource;

use JMS\Serializer\Annotation\Type;
use Mauchede\RancherApi\Exception\InvalidActionException;

/**
 * Container represents a Rancher resource typed as "container".
 *
 * @author Morgan Auchede <morgan.auchede@gmail.com>
 */
class Container extends AbstractResource
{
    /**
     * @var string[]
     *
     * @Type("array<string>")
     */
    private $command;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $description;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $imageUuid;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $name;

    /**
     * @var bool
     *
     * @Type("boolean")
     */
    private $stdinOpen = true;

    /**
     * @var bool
     *
     * @Type("boolean")
     */
    private $tty = true;

    /**
     * Gets the commands
     *
     * @return array
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Gets the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the UUID image.
     *
     * @return string
     */
    public function getImageUuid()
    {
        return $this->imageUuid;
    }

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
        return 'container';
    }

    /**
     * Determines if the container is purgeable.
     *
     * @return bool
     */
    public function isPurgeable()
    {
        return isset($this->actions['purge']);
    }

    /**
     * Determines if the container is restartable.
     *
     * @return bool
     */
    public function isRestartable()
    {
        return isset($this->actions['restart']);
    }

    /**
     * Determines if the container is startable.
     *
     * @return bool
     */
    public function isStartable()
    {
        return isset($this->actions['start']);
    }

    /**
     * Determines if the console is in interactive mode.
     *
     * @return boolean
     */
    public function isStdinOpen()
    {
        return $this->stdinOpen;
    }

    /**
     * Determines if the container is stoppable.
     *
     * @return bool
     */
    public function isStoppable()
    {
        return isset($this->actions['stop']);
    }

    /**
     * Determines if the console is in TTY mode.
     *
     * @return boolean
     */
    public function isTty()
    {
        return $this->tty;
    }

    /**
     * Purges the container.
     *
     * @throws InvalidActionException if the container can not be purged.
     */
    public function purge()
    {
        if (!isset($this->actions['purge'])) {
            throw new InvalidActionException(sprintf('Impossible to purge the container "%s" (current state "%s").', $this->id, $this->state));
        }

        $this->client->post($this->actions['purge']);
    }

    /**
     * Restarts the container.
     *
     * @throws InvalidActionException if the container can not be restarted.
     */
    public function restart()
    {
        if (!isset($this->actions['restart'])) {
            throw new InvalidActionException(sprintf('Impossible to restart the container "%s" (current state "%s").', $this->id, $this->state));
        }

        $this->client->post($this->actions['restart']);
    }

    /**
     * Sets the command.
     *
     * @param string[] $command
     *
     * @return $this
     */
    public function setCommand(array $command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Sets the description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets the UUID image.
     *
     * @param string $imageUuid
     *
     * @return $this
     */
    public function setImageUuid($imageUuid)
    {
        if ('docker:' !== substr($imageUuid, 0, 7)) {
            $imageUuid = 'docker:' . $imageUuid;
        }

        $this->imageUuid = $imageUuid;

        return $this;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Starts a container.
     *
     * @throws InvalidActionException if the container can not be started.
     */
    public function start()
    {
        if (!isset($this->actions['start'])) {
            throw new InvalidActionException(sprintf('Impossible to start the container "%s" (current state "%s").', $this->id, $this->state));
        }

        $this->client->post($this->actions['start']);
    }

    /**
     * Stops a container.
     *
     * @param bool $remove  Determines if the container must be removed after the action.
     * @param int  $timeout Determines the time to wait before the shutdown.
     *
     * @throws InvalidActionException if the container can not be stopped.
     */
    public function stop($remove = false, $timeout = 0)
    {
        if (!isset($this->actions['stop'])) {
            throw new InvalidActionException(sprintf('Impossible to stop the container "%s" (current state "%s").', $this->id, $this->state));
        }

        $this->client->post($this->actions['stop'], array(
            'remove' => $remove,
            'timeout' => $timeout
        ));
    }
}
