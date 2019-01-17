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

Init widget
---

When creating an instance of a widget, the following functions are called inside the widget: `initConfig`, and after `boot`.


Configuration
---

The `initConfig` function defines the parameters of this widget, for example:

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

The entire list of widget parameters can be obtained by the function `getConfig`

```php
$widget->getConfig()
```

Now, after we add a new parameter `title`, we can assign a value to it:

```php
$widget->setOptions([
        'title' => 'This is title'
    ]);
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