<?php namespace Keerill\Widgets\Traits;

use Illuminate\Support\Arr;


/**
 * Обработчик локальных событий
 */
trait Events
{
    /**
     * @var array Массив подключенных функций к событию.
     */
    protected $events = [];

    /**
     * Привязываение функции к событию
     *
     * @param string $eventName Название события
     * @param $callback
     * @return self
     */
    public function bindEvent(string $eventName, $callback)
    {
        $this->events[$eventName][] = $callback;
        return $this;
    }

    /**
     * Удаление связей к данному событию
     *
     * @param string $eventName Название события
     * @return self
     */
    public function unbindEvent(string $eventName = null)
    {
        if ($eventName === null) {
            unset($this->events);
            return $this;
        }

        if (isset($this->events[$eventName]))
            unset($this->events[$eventName]);

        return $this;
    }

    /**
     * Fire an event and call the listeners.
     * @param string $eventName Event name
     * @param array $params Event parameters
     * @param boolean $halt Halt after first non-null result
     * @return array Collection of event results / Or single result (if halted)
     */
    public function fireEvent($eventName, $params = [], $halt = false)
    {
        $params = Arr::wrap($params);
        $result = [];

        if (isset($this->events[$eventName])) {
            foreach ($this->events[$eventName] as $callback) {
                $response = call_user_func_array($callback, $params);
                if (is_null($response)) continue;
                if ($halt) return $response;
                $result[] = $response;
            }

        }

        return $halt ? null : $result;
    }
}
