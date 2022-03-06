# Sharp framework

Performant lightweight MVC framework. Ready to build Web Apps, APIs and Microservices.

## Features

- MVC
- Routing
- ORM
- Templating
- Caching
- Input validation

## Setup

Enter ```config.php``` and change ```DB_*``` variables for your own env.

## Usage

### Routing
The function ```route()``` is a helper function that returns ```Bramus\Router\Router``` class. See [documentation](https://github.com/bramus/router). Uses namespace ```App\Controllers```.

```php
route("/", function() {
    return view("index");
});

route("/cart", "CartController@view");
route(POST, "/cart/add", "CartController@add");
route(DELETE, "/cart/add", "CartController@remove");
```

### Database

```php

// Get first page with 10 users
db("SELECT * FROM users")->paginate(1, 10)->get();

// Get first item of users table
db("SELECT * FROM users", [["id", 1], ["email", "!=", "abc@abc.abc"]])->first();

// Update users table
db("UPDATE users SET name='ABC'", [["id", 1]])->exec();
```

### Model View Controller(MVC)
All in ```app``` folder.

#### Views
```php
// Template: /app/Views/user/profile.html.twig
view("user/profile", ["user" => $user]);
```

#### Static views
Views that are returned if the url path is equals to the path of the template starting as ```app/Views/static/``` as root folder.
```
Url: /support/faq
Template: /app/Views/static/support/faq
```

### Caching
See [documentation](https://symfony.com/doc/current/components/cache.html#cache-component-psr6-caching).

### Input validation
See [documentation](https://github.com/Wixel/GUMP).

### Templating
See [documentation](https://twig.symfony.com/doc/3.x/).
