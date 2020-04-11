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
