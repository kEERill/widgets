<?php namespace Keerill\Widgets\Traits;

use Illuminate\Support\Arr;

/**
 * Добавляет функции для работы с параметрами объекта
 * @author kEERilll
 */
trait Options
{
    /**
     * @var array $config Массив параметров, которые можно являются параметрами виджета
     */
    protected $config = [];

    /**
     * @var array $reserveNames Название параметров, которые нельзя добавлять
     */
    protected $configReserveNames = ['options', 'config'];

    /**
     * @var array $reserveNames Название параметров, которые нельзя добавлять CACHE
     */
    protected $configReserveNamesCache = null;

    /**
     * Возвращает массив параметров
     * @return array
     */
    public function getConfig()
    {
        return Arr::wrap($this->config);
    }
    
    /**
     * Возвращает названия параметров, для которых отключены заполнение функциями
     * @return array
     */
    public function getConfigMethods()
    {
        return Arr::wrap($this->configMethods);
    }

    /**
     * Назначает новые значения параметров
     *
     * @param array $options Параметры, которые необходимо задать
     * @return self
     */
    public function setOptions(array $options)
    {
        $config = Arr::only($options, $this->getConfig());

        if (count($config) > 0) {
            foreach ($config as $key => $value) {
                if (method_exists($this, 'set' . studly_case($key))) {
                    call_user_func([$this, 'set' . studly_case($key)], $value);
                    continue;
                }

                $this->{$key} = $value;
            }
        }

        return $this;
    }
    
    /**
     * Массовое добавление параметров к классу
     * @param array $config Параметры
     * @return void
     */
    public function addConfigOptions(array $config)
    {
        foreach ($config as $option) {
            $this->addConfigOption($option);
        }
    }

    /**
     * Добавлает новый параметр к классу
     * @param string Название параметра
     * @return void
     */
    public function addConfigOption(string $option)
    {
        if (in_array($option, $this->getReserveNames())) {
            return false;
        }

        if (!in_array($option, $this->config)) {
            $this->config[] = $option;
            return true;
        }

        return false;
    }

    /**
     * Удалает несколько параметров
     * @param array Параметры, которые слудет удалить
     * @return void
     */
    public function removeConfigOptions(array $options)
    {
        $config = Arr::only($options, $this->getConfig());

        foreach ($config as $option) {
            $this->removeConfigOption($option);
        }
    }

    /**
     * Удаляет параметр
     * @param string Название параметра
     * @return void
     */
    public function removeConfigOption(string $option)
    {
        foreach ($this->getConfig() as $key => $name) {
            if ($option === $name) {
                unset($this->config[$key]);
            }
        }
    }

    /**
     * Возвращает зареверзированные название параметров, которые нельзя
     * добавлять
     * 
     * @return array
     */
    public function getReserveNames()
    {
        if ($this->configReserveNamesCache === null) {
            $this->configReserveNamesCache = Arr::wrap($this->configReserveNames);

            if (property_exists($this, 'reserveNames')) {
                $this->configReserveNamesCache = array_merge(
                    $this->configReserveNamesCache, $this->reserveNames
                );
            }
        }

        return $this->configReserveNamesCache;
    }
}
