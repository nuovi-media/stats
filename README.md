# NuoviMedia / Stats

This is a project for a website that collects some statistiscs for a group of Letterboxd users

## How to install
```shell
git clone https://github.com/nuovi-media/stats.git target_directory_name
cd target_directory_name
composer install
cp .env.example .env
php artisan nm:install
```

The installation script will ask you for basic configuration settings.

You should then configure your webserver to serve the `/public` directory.
