![Logo](.github/images/logo.png)
![Screen 1](.github/images/screen-1.png)
# PBL Vendor Project

## About Porject
> Some information ...

## Online version
[>> VENDER.GOUGO.UZ <<](https://vender.gougo.uz/)

## Requirements
- PHP ^8.0.2
- Composer 2
- Laravel v10
- npm v9.6.0
- node v18.1.0

## Laravel required PHP Extensions
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Install guide

Composer install
```shell
composer install
```

NPM install
```shell
npm install
```

Generate new key
```shell
php artisan key:generate
```

Make storage folder to public
```shell
php artisan storage:link
```

Set .env database variables
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pbl-vendor-laravel
DB_USERNAME=root
DB_PASSWORD=
```

Clear all cache, config files
```shell
php artisan optimize:clear
```

Drop table and create new, + seeder
```shell
php artisan migrate:fresh --seed
```

Generate API for Vue usage
```shell
php artisan api:token
```

Run Laravel server
```shell
php artisan serve
```

Run Vite server (Frontend)
```shell
npm run dev
```

## Database Diagram:
![Database](.github/images/database.png)
- https://dbdiagram.io/d/6406330c296d97641d85d802

## Screenshots
![Github](.github/images/github-1.png)
![Github](.github/images/github-2.png)
![Screen 1](.github/images/screen-1.png)
![Screen 2](.github/images/screen-2.png)
![Screen 3](.github/images/screen-3.png)
![Screen 4](.github/images/screen-4.png)
![Screen 5](.github/images/screen-5.png)
![Screen 6](.github/images/screen-6.png)
![Screen 7](.github/images/screen-7.png)
![Screen 8](.github/images/screen-8.png)
![Screen 9](.github/images/screen-9.png)
![Screen 10](.github/images/screen-10.png)


## Used articles
- https://www.binaryboxtuts.com/php-tutorials/generating-pdf-from-html-in-laravel-8/
- https://bagisto.com/en/how-to-generate-a-pdf-in-laravel-view/
- https://github.com/barryvdh/laravel-dompdf

## Support
> If there are any problems, please leave a issue
>
[ > Click on the link to write a issue](https://github.com/KIUT-Projects/pbl-vendor-laravel/issues)

## Authors
- ISE-51U - Umarov Kamoliddin ([@UzSoftic](https://github.com/uzsoftic))
- ISE-51U - Abdukhamidov Abdurakhmon ([@AbdurakhmonAbdukhamidov](https://github.com/AbdurakhmonAbdukhamidov))
- ISE-51U - Zokirov Hojiakbar ([@Khojiakbar07](https://github.com/Khojiakbar07))
- ISE-52U - Rajabboyev Inoyatulla ([@uz-developer](https://github.com/uz-developer))

## Versions
- v0.1 - Pre release
- ...

## Additional

This template should help get you started developing with Vue 3 in Vite.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=johnsoncodehk.volar) (and disable Vetur).
