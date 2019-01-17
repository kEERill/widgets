---
title: Commands
---

# Commands

For easier use of widgets, the following commands have been added:
- `widget:create name` Creating a base widget
- `widget:form name --context=default` Creating a form Widget
- `widget:list name` Creating a list Widget

Also, all current commands can be obtained through

```bash
php artisan
```

Creating a base widget
---

Let's start with the easiest, this is creating a new widget

```bash
php artisan widget:create UserInfo
```

After executing the command, the widget will be located at `app/Widgets/UserInfo.php`. 
As for me, it seemed reasonable to use the app/Widgets folder as the root folder with widgets.

Creating a form widget
---

```bash
php artisan widget:form Forms/CreateUser --context=create
```

As we can see, creating a widget of a form is different from the usual creation of a widget, in that the context parameter is used. 
This parameter characterizes the type of widget: create or update. 
The parameter is optional.

There are 3 types of widget:
- `default` Empty widget with a form in which your logic is added
- `create` A widget is inherited by an empty form widget, but the basic methods for creating a model are also added. You will only need to specify the class of the model.
- `update` Almost the same as create, but in this case the model save methods are used.

Creating a list widget
---

```bash
php artisan widget:list List/Users
```

There is nothing unusual here, also creates a list widget in the `app/Widgets/List/Users` folder
