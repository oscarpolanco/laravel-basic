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
