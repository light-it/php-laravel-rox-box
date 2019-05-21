## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

---

## Deploy project:

1. Clone project from git
```
git clone https://github.com/light-it/php-laravel-rox-box.git
git checkout master
```

2. Checkout staging branch
3. Create MySQL schema
4. Make sure that your .env file is correct
```
cp .env.example .env

set DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=database_username
    DB_PASSWORD=database_password
```

5. Create virtual host
6. Execute the next commands

  - 6.1. to install/update packages:
```
composer install
```
  - 6.2. to init application key:
```
php artisan key:generate
```

  - 6.3. to apply new config-params:
```
php artisan config:clear
```

  - 6.4. install npm packages:
```
npm install
```

  - 6.5. to create tables in the DB:
```
php artisan migrate
```

  - 6.6. to run seeders for DB:
```
php artisan db:seed
```

  - 6.7. to create routes:
```
php artisan route:clear
```

  - 6.8. to build all css and js scripts (one of these commands) [optional]:
```
npm run development
npm run production
npm run watch
```
---

