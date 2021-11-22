# ExerciseLoop

Project carried out as part of the MAW1.1 module.

The objective is to reproduce the following website [https://stormy-plateau-54488.herokuapp.com](https://stormy-plateau-54488.herokuapp.com)

[Workflow](https://penfu.notion.site/Projet-8658d04295c949c59c4249380d65ac03)

## Technical specifications

- PHP 8.0.10

## Local Initialisation

### Install depedencies

Move into code directory `src/` and install packages dependencies.

```php
composer install
npm install
```

### Environment

Setup localy the database and your `.env.php` file from `.env-example.php`.

### Start the server

```php
php -S localhost:8000 -t src/public
```

## Mockup

Interactive [prototype](https://www.figma.com/proto/6V3spUnNzcCOZJEgozH3uS/Untitled?page-id=0%3A1&node-id=1%3A38&viewport=271%2C48%2C0.69&scaling=contain&starting-point-node-id=1%3A38) of the views.

## Lib

- [FastRoute](https://github.com/nikic/FastRoute)
- [normalize.css](https://github.com/necolas/normalize.css)
- [Milligram](https://github.com/milligram/milligram)
- [Font-Awesome](https://github.com/FortAwesome/Font-Awesome)
