<?php
/**
 * Bluz Framework Component
 *
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/framework
 */

declare(strict_types=1);

namespace Bluz\EventManager;

/**
 * Event manager
 *
 * @package  Bluz\EventManager
 * @link     https://github.com/bluzphp/framework/wiki/EventManager
 */
class EventManager
{
    /**
     * @var array list of listeners
     */
    protected $listeners = [];

    /**
     * Attach callback to event
     *
     * @param  string   $eventName
     * @param  callable $callback
     * @param  integer  $priority
     *
     * @return void
     */
    public function attach($eventName, $callback, $priority = 1): void
    {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }
        if (!isset($this->listeners[$eventName][$priority])) {
            $this->listeners[$eventName][$priority] = [];
        }
        $this->listeners[$eventName][$priority][] = $callback;
    }

    /**
     * Trigger event
     *
     * @param  string|Event  $event
     * @param  string|object $target
     * @param  array|object  $params
     *
     * @return string|object
     * @throws EventException
     */
    public function trigger($event, $target = null, $params = null)
    {
        if (!$event instanceof Event) {
            $event = new Event($event, $target, $params);
        }

        if (false !== strpos($event->getName(), ':')) {
            $namespace = substr($event->getName(), 0, strpos($event->getName(), ':'));

            if (isset($this->listeners[$namespace])) {
                $this->fire($this->listeners[$namespace], $event);
            }
        }

        if (isset($this->listeners[$event->getName()])) {
            $this->fire($this->listeners[$event->getName()], $event);
        }

        return $event->getTarget();
    }

    /**
     * Fire!
     *
     * @param  array $listeners
     * @param  Event $event
     *
     * @return void
     */
    protected function fire($listeners, $event): void
    {
        ksort($listeners);
        foreach ($listeners as $list) {
            foreach ($list as $listener) {
                $result = $listener($event);
                if (null === $result) {
                    // continue;
                } elseif (false === $result) {
                    break 2;
                } else {
                    $event->setTarget($result);
                }
            }
        }
    }
}
