# RHZ Chocolate Bars Management

This API provides a way for RHZ to manage their chocolate bars and cocoa batches.

## Requirements

* PHP 7.3 or newer.

## Installation

Start by cloning this repository. 

``` git clone https://github.com/Guilherme-Ferreti/rhz-chocolate-bars.git```

Make sure you have installed Composer. If not, please check its official [guide](http://getcomposer.org/doc/00-intro.md#installation).

After that, install project dependencies by running the following command in your application's root folder:

```composer install```

Copy .env.example to create your own .env file.

```cp .env.example .env```

Configure database connection and run the migrations.

```php artisan migrate```

If you want to seed some records, just call:

```php artisan db:seed```

Finally, create an API auth token. This token allow access to some application endpoints. Token length defaults to 24 characters, but you can customize it by using the "--length" flag. 

```php artisan api:create-auth-token --length=50```

## Documentation

API documentation can be accessed using the following link:
https://rhz-chocolate-bars-api-docs.vercel.app/

Database modeling documentation is also avaliable:
https://drawsql.app/fallhealer/diagrams/rhz-chocolate-bars