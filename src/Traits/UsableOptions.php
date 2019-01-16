<?php namespace Keerill\Widgets\Traits;

/**
 * Добавляет функции для работы с параметрами объекта
 * @author kEERilll
 */
trait UsableOptions
{
    /**
     * @var array $config Массив параметров, которые можно являются параметрами виджета
     */
    protected $config = [];

    /**
     * Назначает новые значения параметров
     *
     * @param array $options Параметры, которые необходимо задать
     * @return self
     */
    public function setOptions(array $options) : self
    {
        $config = array_only($options, $this->config);

        if (count($config) > 0) {
            foreach ($config as $key => $value) {
                if (method_exists($this, 'set' . studly_case($key) . 'Option')) {
                    $this->{'set' . studly_case($key) . 'Option'} ($value);
                    continue;
                }

                $this->{$key} = $value;
            }
        }

        return $this;
    }

    /**
     * Добавляет новые доступные параметры для данного класса
     *
     * @param array $config Параметры
     * @return void
     */
    public function fillConfig(array $config) : void
    {
        foreach ($config as $option) {
            if (!in_array($option, $this->config)) {
                $this->config[] = $option;
            }
        }
    }
}
