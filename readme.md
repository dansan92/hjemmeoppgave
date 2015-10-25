# Hjemmeoppgave by Daniel Sandnes

## Installation (Windows)

Open the project root with Windows Explorer (filutforsker) and write CMD in the window, or open CMD and navigate to the project folder.

Run the command **composer install**.

Create an empty MySQL-database (or use your an existing one). I used WAMP and localhost/phpmyadmin with MySQL-database 'Hjemmeoppgave'.

Create a new file in the root of the project called **.env**, copy the content from .env.example to .env and replace the following:

**DB_DATABASE=homestead**<br/>
**DB_USERNAME=homestead**<br/>
**DB_PASSWORD=secret**<br/>

With the details to your own database, for me this was the following:

**DB_DATABASE=hjemmeoppgave**<br/>
**DB_USERNAME=root**<br/>
**DB_PASSWORD=**<br/>

Save the file and run **php artisan key:generate** to generate a new key for the project.

### Fill the database with users

To add an administrator and a normal user to the database run the two following commands:

**php artisan migrate**<br/>
**php artisan db:seed**

This will give you two users: **admin@admin.no** and **user@user.no** (passwords: admin and user).

PS: you can't create an admin user through the project itself, these have to be made manually in the database or through seeding.

**_IMPORTANT_**: The application is made with the public folder as root, which means the application won't work if you don't set this. Run the command **php artisan serve --port=1337** from the project root (you can use any port).
If this works URLs should be on the form: 'http://localhost:1337/auth/register'

## How to use the application?

If you followed the installation instructions, go to **http://localhost:1337** to find the front page.
From there you'll be able to register a new user or login with an existing one.
Click 'Logg inn' and login with the seeded administrator user: admin@admin.no (password: admin).
You will now be able to upload images from the upload panel or approve/decline images from the control panel.
Click 'Last opp' and upload an image from either your local PC or Instagram.
Go to the control panel and approve the uploaded image, which will now show up on the front page or '/images'.
Other than that you're free to do as you wish, good luck! :)

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
