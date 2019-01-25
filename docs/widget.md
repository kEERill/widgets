# Widget

- [Creating](#creating)
- [Initialization](#initialization)
- [Configuration](#configuration)
- [Rendering](#rendering)

Creating
---

Let's start with the easiest, this is creating a new widget

```bash
php artisan widget:create UserInfo
```

After executing the command, the widget will be located at `app/Widgets/UserInfo.php`. 
As for me, it seemed reasonable to use the app/Widgets folder as the root folder with widgets.

`WidgetBuilder` is piped to create and display a widget, `Keerill\Widgets\Facades\WidgetBuilder`.

```php
$widget = WidgetBuilder::make(\App\Widgets\UserInfo::class, ['optionName' => 'optionValue']);

echo $widget->render()
```

Initialization
---

When creating an instance of a widget, the following functions are called inside the widget: `initConfig`, and after `boot`.


Configuration
---

The `initConfig` function defines the parameters of this widget.The entire list of widget parameters can be obtained by the function `getConfig`

```php
$widget->getConfig()
```
Example:

```php
/**
 * @var string Title, default value = null
*/
public $title = null;

public $description = null;

protected function initConfig()
{
    parent::initConfig();

    /*
     * Add parameters `title` and `description`
     */
    $this->addConfigOption('title');
    $this->addConfigOption('description');

    /*
    * or Bulk Add Parameters
    */
    $this->addConfigOptions(['title', 'description']);
}
```

Now we can get the value of this parameter:

```php
$widget->title
```

Or you can do it like this:

```php
/**
 * @var string Title, default value = null
*/
protected $title = null;

public function getTitle()
{
    return $this->title;
}

protected function initConfig()
{
    parent::initConfig();

    /*
    * Here we add our parameter with the name `title` to the list of already available parameters.
    */
    $this->addConfigOption('title');
}
```

Now we can get the value of this parameter:

```php
$widget->getTitle()
```

Redefinition of parameters - a case when you assign checks to a parameter when assigning a value to a parameter.

In order that the filling of parameters was called through a function, this parameter should be added to the list via the function `addConfigMethod`:

```php
/**
 * @var string Title, default value = null
*/
protected $title = null;

public function getTitle()
{
    return $this->title;
}

protected function setTitle($value)
{
    if (is_string($value)) {
        $this->title = $value;
    }
}

protected function initConfig()
{
    parent::initConfig();

    /*
    * Here we add our parameter with the name `title` to the list of already available parameters.
    */
    $this->addConfigOption('title');
    $this->addConfigMethod('title');
}
```

Those. before the widget assigns a parameter value, it looks for the `setParamName` function. If the function is present, the parameter assignment is passed to it.

Like the `addConfigOption` method, the `addConfigMethod` function has an analog for bulk filling `addConfigMethods`.

```php
/**
 * @var string Title, default value = null
*/
public $title = null;

public $description = null;

/* 
    ... 
        setTitle, setDescription 
    ... 
*/

protected function initConfig()
{
    parent::initConfig();

    $this->addConfigOptions(['title', 'description']);
    $this->addConfigMethods(['title', 'description']);

    /**
     * If all parameters can be filled in through a function call, then use this method.
     */
    $this->addConfigOptionsWithMethods(['title', 'description']);
}
```

Assigning values to a widget
---
Assignment of values inside the widget

```php
$this->setOptions([
    'title' => 'This is title',
    ...
]);
```

Assigning values outside the widget:

```php
$widget->setOptions([
    'title' => 'This is title',
    ...
]);
```

You can also assign parameters when creating a widget:

```php
$widget = WidgetBuilder::make(\App\Widgets\UserInfo::class, ['title' => 'This is title']);

echo $widget->getTitle() // This is title
```


Rendering
---

Render widget is called by the `render` method.

```php
echo $widget->render()
```

Before starting to render, the widget calls the `prepareRender` function, where you can initialize your variables, etc.

```php
/**
 * @var string Description
 */
protected $description = null;

public function getDescription()
{
    return $this->description;
}

protected function prepareRender()
{
    $this->description = 'This is description widget';
}
```
But there is one thing, but if you do not call the `render` method, then accordingly the `prepareRender` method will not be called, therefore, the `description` variable will be empty

```php
echo $widget->getDescription() // null
```

If you need this variable anyway, use the `boot` method.

```php
/**
 * @var string Description
 */
protected $description = null;

public function getDescription()
{
    return $this->description;
}

protected function boot(array $options = [])
{
    $this->description = 'This is description widget';
}

...

echo $widget->getDescription() // This is description widget
```

Now let's move on to the widget renderer itself. There is a `template` variable in the widget, which determines which template will be rendered, and you should remember that the `widget` variable will be passed to this template, i.e. instance of this widget.

```php
/**
 * @var string Description
 */
protected $description = null;

/**
 * @var string Template
 */
protected $template = 'widget.userinfo';

public function getDescription()
{
    return $this->description;
}

protected function prepareRender()
{
    $this->description = 'This is description widget';
}
```

In `widget/userinfo.blade.php`

```php
echo $widget->getDescription() // This is description widget
```

Render widget

```php
echo $widget->render(); // This is description widget
```