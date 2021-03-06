# Laravel Basic

## Section 1: Introduction

`Laravel` is a framework for creating sides using `PHP` that works well with the `MySQL` database. It has a couple of pre-packaged features that are very useful like the following:

- [blade](https://laravel.com/docs/7.x/blade) - That is a template engine that will help us to build dynamic HTML sites.
- [auth](https://laravel.com/docs/7.x/authentication#introduction) - Came with an authentication system.
- [eloquent](https://laravel.com/docs/7.x/eloquent) - Is an [ORM](https://en.wikipedia.org/wiki/Object-relational_mapping) that will help us to query the database.

Use an `MVC` pattern to structure it code so we will have a representation of some information on the database in the `model`; the `view` that is a template that we send to the browser and a `controller` that get information of the `model` and inject that to the `view`.

## Section 2: Installing Laravel

On this section, we will see how to install `Laravel` in your local machine but first, you need some pre-requisites on your machine to begin the process

### Pre-requisites

- `PHP` (version 7.2 or mayor)
    * Since I'm using `mac` here is a command that you can use: `curl -s http: //php-osx.liip.ch/install.sh | bash -s 7.2`
    * Use `php -v` to see if work
    * If you got an older version and you continue see that version after using the `php -v` command type the following on your console: `export PATH=/usr/local/php5/bin:$PATH`
- [MySQL](https://www.mysql.com/downloads/)
- [Composer](https://getcomposer.org/download/)
- [Nodejs](https://nodejs.org/en/download/)

### Steps to Install Laravel

- First, on your console install `Laravel` globally(globally so we can create new projects using `Laravel` on any directory) using:
    `composer global require laravel/installer`
- Use `laravel -V` to see is the install was successful

### Steps to generate and run a project using Laravel

- On the directory that you won't use the `new` command to create a project
    `laravel new name_of_the_project`
- Enter to the new directory that `Laravel` create for your project
- Use the `install` command to install all the dependencies
    `npm install`
- Use the following command to start the server:
    `php artisan serve`
- Go to your [localhost:8000](http://localhost:8000/)

## Section 3: Routes and views

When the browser sends an `HTTP` request to a server that is hosting your website using `Laravel`; the request will be sent to a `route` file that will look to that request and decide what to do next and that could be processing some data or get some data if is needed; when we have that data we injected to our template and compile it (Because we are using `blade` we need to compile the file) or if it doesn't need data just compile the file and send it to the user that made the request.

### Creating a route

One of the directories that `Laravel` create when you create your project is the `routes` directory that will handle all the request of your app. Here are the basic steps to create your route.

- Go to the `routes` directory
- Open the `web.php` file (For now, is just a basic example of routes so we're gonna concentrate on this file)
- Use the `Route` class to create your custom route (For this example we're gonna handle the `/pizza` request)
   
    ```php
    Route::get('/pizzas', function () {
        return view('pizzas'); // return a view
        // return 'pizzas!;' // return a string and convert to text/html
        // return [name => 'veg pizza', 'base' => 'classic'] // return an array and it will convert it to a JSON  
    });
    ```
#### Note:

If you return a `view` need to create a file with all the content of the view. Check the `view` section.

### Creating a view

Another directory that is created by `Laravel` is the `resources` directory that will handle the `views` and some statics files.

Here are the steps to create a `view`

- Go to the `resources/views` directory
- Create a new file with `.blade.php` as it extension
- Add your content

#### Note:

We create the `pizzas.blade.php` as our `view` following the example of the `route` that we did before.

## Section 4: Passing values to the view

To pass values from the `route` to the `view` you just need to add a second parameter to the `view` function that we return when we use the `Route` class like the following example:

```php
Route::get('/pizzas', function () {
    $pizza = [
        'type' => 'hawaiiian',
        'base' => 'cheese crush',
        'price' => '10'
    ];
    return view('pizzas', $pizza);
});
```

Then you will have access to the `Keys` that you send on the as a variable on the view. To use it just need to add double curly braces  and a dollar sign before it names like this example:

```php
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Pizza List
        </div>
        <p>{{ $type }} {{ $base }} {{ $price }}</p>
    </div>
</div>
```

This will also escape the value of the variable automatically as part of the `blade` functionality.

## Section 5: Blade Basic

On `Blade` you have some directives that are gonna help us to control the way that we show or not show some information on our `view`. Here are some basic examples:

- `if` statement: You can use a condition to decide what you need to render.
    ```php
    @if($price > 15)
        <p>This pizza is expensive</p>
    @elseif($price < 5)
        <p>This pizza is cheap</p>
    @else
        <p>This pizza is normally priced</p>
    @endif
    ```

- `unless` statement: Conditional that is de negative of an `if` statement.

    ```php
    @unless($base == 'cheesy crust')
        <p>You don't have chessy crust</p>
    @endunless
    ```

- `php` block: You can set a block that you can run `PHP` code in your `view`.

    ```php
    @php
        $name = 'shaun';
        echo($name);
    @endphp
    ```

## Section 6: Blade loops

On `Blade` we can `loop` throw the items that we receive from the `routes` like the following examples:

For this example we send some data in an `array` in the `/pizzas` route:

`route/web.php`

```php
Route::get('/pizzas', function () {

    $pizzas = [
        ['type' => 'hawaiian', 'base' => 'chessy crust'],
        ['type' => 'volcano', 'base' => 'garlic crust'],
        ['type' => 'veg supreme', 'base' => 'thin & crispy']
    ];

    return view('pizzas', ['pizzas' => $pizzas]);
});
```

- `for`: Loop the item along as on each cycle the condition that you put to match.

    ```php
    @for($i = 0; $i < 5; $i++)
        <p>{{ $pizzas[$i]['type'] }}</p>
    @endfor
    ```
- `forEach`: Loop throw every item on a `array`

    ```php
    @foreach ($pizzas as $pizza)
        <div>
            {{ $loop->index }} {{ $pizza['type'] }} - {{ $pizza['base'] }}
            @if($loop->first)
                <span>First in the loop</span>
            @endif
            @if($loop->last)
                <span>Last in the loop</span>
            @endif
        </div>
    @endforeach
    ```
    The `forEach` have also access an object call `$loop` that have some information like the `index` of the current cycle or the `first` and `last` property that are only `true` in certain point of the cycles.

## Section 7: Layout files

On `Blade` we can have files that represent those elements that are present on all pages like the `header` and `footer`; we only need to use `extends` and define a `content`. Here is an example:

- First, create new directory call `layouts` (Just an example can be anything or on the same `view` directory)
- Create a file called `layout`
- Delete the elements that are repeated on the `welcome.blade.php` and `pizza.blade.php`
- Add those elements to the `layout` file
- At the top of the `welcome.blade.php` and `pizza.blade.php` add `@extends('layouts.layout')` (No need to use `/` just `.`)
- Add on the current `content` of the `welcome.blade.php` and `pizza.blade.php` add `@section('content')` (could be any name) and at the end of it `@endsection`
- On the `layout` file add `@yield('content')` (need to be the same section that you need to appear) where you need the `section` to appear

Here are the example files:

`pizzas.blade.php`

```php
@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Pizza List
        </div>

        @foreach ($pizzas as $pizza)
            <div>
                {{ $loop->index }} {{ $pizza['type'] }} - {{ $pizza['base'] }}
                @if($loop->first)
                    <span>First in the loop</span>
                @endif
                @if($loop->last)
                    <span>Last in the loop</span>
                @endif
            </div>
        @endforeach

    </div>
</div>
@endsection
```

`welcome.blade.php`

```php
@extends('layouts.layout')

@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}">Home</a>
        @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
        @endif
        @endauth
    </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Pizza House<br />
            The North Best Pizzas
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://blog.laravel.com">Blog</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://vapor.laravel.com">Vapor</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
@endsection
```

`layout.blade.php`
```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html,
            body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links>a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            footer {
                background: #eee;
                padding: 20px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        @yield('content')

        <footer>
            copyrigth 2020 Pizza House
        </footer>
    </body>
</html>
```

## Section 8: css & images

On the directories that `Laravel` creates for us when we start the project; we got a `public` folder that is the directory that will expose to the browser so you can put your statics files there.

## Section 9: Query Parameters

On our `route` file we can get `query parameters` and send it to the `view` using the `request` function with the name of the `query parameter` that you need. Here is an example using the previews build pizzas `route` using this url `http://localhost:8000/pizzas?name=mario&age=30`:

```php
Route::get('/pizzas', function () {

    $pizzas = [
        ['type' => 'hawaiian', 'base' => 'chessy crust'],
        ['type' => 'volcano', 'base' => 'garlic crust'],
        ['type' => 'veg supreme', 'base' => 'thin & crispy']
    ];

    return view('pizzas', [
        'pizzas' => $pizzas,
        'name' => request('name'),
        'age' => request('age')
    ]);
});
```
## Section 10: Routes parameters (Wildcard)

The `route parameter` or `wildcard` is like a `query parameter` without a variable and don't need a question mark is actually part of the url. To catch that parameter we just need to create a route that match the url that containg the `route parameter`

```php
Route::get('/pizzas/{id}', function ($id) {
    return view('details', ['id' => $id]);
});
```

### Note:

We create a `details` view for the example

## Section 11: Controllers

Like we said before `Laravel` uses a `model`; `view`; `controller` design param. The `controller` register functions that we call `actions` that fire when a certain route handler needs it. At this moment on the example, we are not using the `controllers` just the `view`. Here is the example of creating and use the `controller`.

- First on the root of your project use artisan to create the controller with the following command:
    `php artisan make:controller NameOfYourController`
- Go to the `app/HTTP/Controllers`
- Go to the new file that you create before with the `artisan` command
- Inside of the class add the logic that you need to run when a route handler needs (Here are an example using the logic that we add in the past)

    `PizzaController.php`

    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class PizzaController extends Controller
    {
        public function index()
        {
            $pizzas = [
                ['type' => 'hawaiian', 'base' => 'chessy crust'],
                ['type' => 'volcano', 'base' => 'garlic crust'],
                ['type' => 'veg supreme', 'base' => 'thin & crispy']
            ];

            return view('pizzas', [
                'pizzas' => $pizzas,
                'name' => request('name'),
                'age' => request('age')
            ]);
        }

        public function show($id)
        {
            return view('details', ['id' => $id]);
        }
    }
    ```
- Go to your `routes` and eliminate all the callback functions (we are using the previews examples) and use the class that you created on the `controller` file.

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pizzas', 'PizzaController@index');
Route::get('/pizzas/{id}', 'PizzaController@show');
```

### Notes

- The functions that we create on the `controller` call `actions`
- `index` and `show` are naming conventions that we gonna target in a later section

## Section 12: Mysql

On the begining as a pre-requisite we need to install `Mysql` becuase we are gonna store the database there. So at this moment we need to create our database. Here are the steps that we follow (I'm using mac):

- On your console type the following command: `mysql -u root -p`
- When you access to `Mysql` use this command to create the database: `create database nameofyourdatabase;`
- Go to your `.env` file in the root of your project
- Update the following constants:
    * `DB_DATABASE` => Use the name of your database.
    * `DB_USERNAME` => Use your database `username`
    * `DB_PASSWORD` => Put the database `password`

## Section 13: Migration basic

The `migrations` allow us programmable from our code to define the structure of the tables in our `database` on `Laravel` we achieve this with the `migrations` files. This files are placed in the `database/migration` directory and are created by `artisan` and have a `class` that represent our `migration` with 2 functions the `up` function is responsible for creating and defining the structure of the `table` and the `down` function that `drop` the `table` if exists.

### Basics of creating a table

On the `up` function we have a `schema::create` that receive the name of the table and a function with all his columns like the example we got next:

```php
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
```

- `id()` => Add an `id` and increment its values each time a record is added.
- `string()` => Add a column that recive a `string`.
- `string()->unique()` => Add a column that recive a `string` and should be `unique`.
- `timestamp()` => Add a `time` value to the column.
- `timestamp()->nullable()` => Add a `time` value to the column and can be null.
- `rememberToken()` => Token field.
- `timestamps()` => Add a `timestamp` using the server clock.

### Creating a migration and add columns to your table

To create your `migration` you just need to:

- On your root directory use the `artisan make` command for `migrations`
    `php artisan make:migration name_of_your_migration_file`
- Then check on your `database/migrations` directory if your `migration` file is created
- On that `migration` file in the `up` function add every column that you need
- To add the `table` on your `database` just run the `artisan migrate` command; that will run the `up` function on every `migration` file
    `php artisan migrate`
- Check on `Mysql` if your table exists

#### Note

If you have issues creating the table you can use the `php artisan migrate:fresh` but be careful because it will drop all tables and run all the migrations again.
