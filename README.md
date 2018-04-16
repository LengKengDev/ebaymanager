# EbayManager | PHP Web Application

# Installation

* Framework: Laravel 5.6

## System required
- CentOS 7
- Apache 2.4.x / Nginx 1.13.x
- PHP
    - Version: >= 7.1
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
    - Mysqlnd Driver
- Mysql > 5.6
- Ruby 2.4.x
- NodeJS
    - Version: >= 8.0.0
    - Yarn global package
- Composer 1.6.x

## Setup environment

### NodeJS

* NVM 

```bash
$ curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash
$ nvm --version
```
* NodeJS

```bash
$ nvm install 8.0.0
$ node -v
```
    
* Yarn

```bash
$ npm install -g yarn
$ yarn --version
```
### Composer

```bash
$ sudo curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
$ composer -version
```
## Project Guide

### Install

```bash
$ git clone https://github.com/LengKengDev/ebaymanager.git
$ cd web
$ composer install
$ yarn
$ npm run prod
$ cp .env.example .env
$ chown nginx:nginx storage
```
* Configure apache/nginx server to be the correct `public` folder of the project [File nginx config example](https://gist.github.com/ohmygodvt95/4b2828414aed8a2fc2ba0fd28d3e499d)

- Edit: update your `public` folder project

 Line 14: `root /home/ebay.ebmanagers.net/ebaymanager/public;`
 
 Line 80: `fastcgi_param SCRIPT_FILENAME /home/ebay.ebmanagers.net/ebaymanager/public$fastcgi_script_name;`

### Run

* Configure the correct `.env` file: database, mail, debug ..

```bash
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
```
### Https error

- Edit file `app/Providers/AppServiceProvider.php` to [AppServiceProvider.php](https://gist.github.com/ohmygodvt95/5fb012647919f59eaa3e10176fde50cb)

## Contributors

* Le Vinh Thien | [levinhthien.bka@gmail.com](levinhthien.bka@gmail.com)

## License

The MIT License (MIT). Please see [License File](./LICENSE) for more information.

## Copyright © 2018 GMO-Z.com RUNSYSTEM. All rights reserved.
