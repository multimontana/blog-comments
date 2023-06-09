# Simple MVC PHP Framework

## Description
Test Project With custom 

## Requirements
PHP >=8.0.1
Composer

## Tested on 
PHP 8.0.1 Apache
PHP 8.0.1 Docker

## Installation
```
git clone https://github.com/multimontana/blog-comments.git
```

## Composer
After the installation on your local or container, run the following command:
```
composer install
```

## DB
At first you need to configure your db credentials in config/config.php folder and create the db with the name that you are configured.

Run the following console command where your composer.json located or importing tables
```
composer run-script run-migrations
```

## On your own:
1. Set up and run your webserver (e.g. Apache);
2. Open your browser;
3. Go to the index page (often localhost).

**Note**: if you decided to put the framework into a subfolder, open */config/config.php* and set up the name of the subfolder here *URL_SUBFOLDER*

## MVC PHP
https://github.com/multimontana/blog-comments.git
