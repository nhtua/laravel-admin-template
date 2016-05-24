This project is a Laravel Admin Template, which has common features for all kind of projects, help you (and help me) go fast to build admin page.
When start new project, we just clone this repo and make it no pain again.
Here is my intention, I hope some people will found and develop more common features.

# Features
In version 1.0

- [x] Admin page with Gentelella UI
- [x] Authentication and authorization with Zizaco/Entrust
- [x] HTML Form template (I hate Laravel Collective)
- [x] Make thumb images from upload
- [ ] Config manager
- [x] User manager

# Installation guide for dev

## Requirements
- PHP enviroment
  + PHP >= 5.5.9
  + OpenSSL PHP Extension
  + PDO PHP Extension
  + Mbstring PHP Extension
  + Tokenizer PHP Extension
- Composer
- Laravel 5.2

## How to install?

You need to use `composer` and some commands to install:
```bash
git clone https://github.com/nhtua/laravel-admin-template.git your-project/
cd /your-project
composer install
cp .env.example .env
php artisan key:generate
```
Then do one of both step:

### 1. Fast-forward
Import /database/seeds/install-*.sql to you database.

### 2. Stupid-forward
Don't want to open MySQL Workbench or generate DB from the scratch, type:

```bash
php artisan migrate:refresh --seed
```
You may want to change default user's infomation before generate db, go edit `./src/database/seeds/UsersTableSeeder.php`.

## Config
You need edit the configuration file `.env` before the first run, change values of:
- APP_ENV: local/production
- APP_DEBUG: true/false. The `false` will hide all error messages
- APP_NAME : The application's name
- APP_URL : The application's domain
- DB_HOST : 127.0.0.1 (default), your MySQL server's IP
- DB_PORT : 3306 (default),  your MySQL server's port
- DB_DATABASE : the database name
- DB_USERNAME : the user, who has privilege to access the DB_DATABASE
- DB_PASSWORD : MySQL user's password
- CACHE_DRIVE: (!IMPORTANT) if you don't use Redis or Memcached, please set the value as `array`. It is needed for Entrust's authentication.
- IMAGE_SIZES : list of all sizes (width) of thumbnail image versions.

At last, you need to point the dev domain to `/root/public` in server configuration. Please follow the user manual of what kind of server you used.

## Login to backend
1. Go to `http://your-domain.dev/dashboard`
2. Login by default account: admin@demo.com / 123456a@
3. Enjoy your-self
