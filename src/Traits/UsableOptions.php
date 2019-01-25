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
     * @var array $configMethods Массив параметров, у которых доступно заполнение параметра через функцию
     */
    protected $configMethods = [];

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
        return array_wrap($this->config);
    }
    
    /**
     * Возвращает названия параметров, для которых отключены заполнение функциями
     * @return array
     */
    public function getConfigMethods()
    {
        return array_wrap($this->configMethods);
    }

    /**
     * Назначает новые значения параметров
     *
     * @param array $options Параметры, которые необходимо задать
     * @return self
     */
    public function setOptions(array $options)
    {
        $config = array_only($options, $this->getConfig());

        if (count($config) > 0) {
            foreach ($config as $key => $value) {
                if (in_array($key, $this->configMethods) && method_exists($this, 'set' . studly_case($key))) {
                    call_user_func([$this, 'set' . studly_case($key)], $value);
                    continue;
                }

                $this->{$key} = $value;
            }
        }

        return $this;
    }

    /**
     * Добавляет новые параметры с возможностью заполнения через функцию
     * @param array
     * @return void
     */
    public function addConfigOptionsWithMethods(array $options) 
    {
        foreach ($options as $option) {
            if ($this->addConfigOption($option)) {
                $this->addConfigMethod($option);
            }
        }
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
        $config = array_only($options, $this->getConfig());

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
     * Добавляет возможность заполнение параметра методом функции
     * @param array
     * @return void
     */
    public function addConfigMethods(array $options)
    {
        foreach ($options as $option) {
            $this->addConfigMethod($option);
        }
    }

    /**
     * Добавляет возможность заполнение параметра методом функции
     * @param string
     * @return void
     */
    public function addConfigMethod(string $option)
    {
        if (
            in_array($option, $this->getReserveNames()) || 
            !in_array($option, $this->getConfig()) ||
            in_array($option, $this->getConfigMethods())
        ) {
            return false;
        }

        $this->configMethods[] = $option;
        return true;
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
            $this->configReserveNamesCache = array_wrap($this->configReserveNames);

            if (property_exists($this, 'reserveNames')) {
                $this->configReserveNamesCache = array_merge(
                    $this->configReserveNamesCache, $this->reserveNames
                );
            }
        }

        return $this->configReserveNamesCache;
    }
}
