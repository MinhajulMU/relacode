# RELACODE (React Laravel Code Generator)

A crud code generator that uses [Inertia.js](https://inertiajs.com/) works with [Laravel](https://laravel.com/) and [React](https://reactjs.org/).

> This is a modification from original [Ping CRM](https://github.com/Landish/pingcrm-react) written in Laravel and React.


## Installation

Clone the repo locally:

```sh
git clone git@github.com:MinhajulMU/relacode.git
cd relacode
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create a MySQl database. You can also use another database (SQLite, Postgres), simply update your configuration accordingly.


Restore database

```sh
mysql -u [user] -p dump-laravel-react-crm.sql < [filename].sql
```
the database already includes the basic configuration of the application

Run artisan server:

```sh
php artisan serve
```

```sh
php artisan storage:link
```

You're ready to go! [Visit Relacode](http://127.0.0.1:8000/) in your browser, and login with:

- **Username:** admin@admin.com
- **Password:** secret

## Run CRUD Generator

To run crud generator, run this in your terminal:

```
php artisan modules:make [table_name]
```

Command will generate basic crud code, crud uses privileged permissions for each user and primary key settings using uuid

## Credits

- Original work by Landish PingCRM React
- Free Theme by ThemeKita
- Code Generator Inspiration By Bardiz12
