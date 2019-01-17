# Widget

- [Creating widget](#creating-widget)
- [Init widget](#init-widget)
- [Configuration](#configuration)

Creating widget
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

Init widget
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

protected function initConfig()
{
    parent::initConfig();

    /*
    * Here we add our parameter with the name `title` to the list of already available parameters.
    */
    $this->fillConfig(['title']);
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
    $this->fillConfig(['title']);
}
```

Now we can get the value of this parameter:

```php
$widget->getTitle()
```

Redefinition of parameters - a case when you assign checks to a parameter when assigning a value to a parameter. For this situation there is a solution:

```php
/**
 * @var string Title, default value = null
*/
protected $title = null;

public function getTitle()
{
    return $this->title;
}

protected function setTitleOption($value)
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
    $this->fillConfig(['title']);
}
```

Those. before the widget assigns a parameter value, it looks for the `setParamNameOption` function. If the function is present, the parameter assignment is passed to it.

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