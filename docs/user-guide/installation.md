# Installation
-----------------

This installation guide will help you install Shorty 1.0.0, the latest iteration of Shorty.

## Server Requirements

The following software is required on your server to run Shorty 1.0.0.
In the case that you cannot fulfill the following requirements (e.g free shared hosting),
you may be interested in looking at a [legacy 1.x release](https://github.com/CodingMonkTech/shorty/releases) of Shorty (now unsupported).


 - Apache, nginx, IIS, or lighttpd (Apache preferred)
 - PHP >=  7.1.3
 - MariaDB or MySQL >= 5.5, SQLite alternatively
 - composer
 - PHP requirements:
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - JSON PHP Extension
    - PHP curl extension
    - XML PHP Extension
    - Ctype PHP Extension
    - BCMath PHP Extension

## Download the source code

If you would like to download a stable version of Shorty, you may check out [the releases page](https://github.com/CodingMonkTech/shorty/releases).

```bash
$ sudo su
# switch to Shorty directory (replace with other directory path if applicable)
$ cd /var/www
# clone Shorty
$ git clone https://github.com/CodingMonkTech/shorty.git --depth=1
# set correct permissions
$ chmod -R 755 shorty

# if you would like to use a specific release, check out
# the tag associated with the release. see link above.
$ # git checkout <tag>

# run only if on Ubuntu-based systems
$ chown -R www-data shorty
# run only if on Fedora-based systems
$ chown -R apache shorty

# run only if on recent Fedora, or other system, with SELinux enforcing
$ chcon -R -t httpd_sys_rw_content_t shorty/storage shorty/.env
```

## Install `composer` dependencies

```bash
# download composer package
curl -sS https://getcomposer.org/installer | php
# update/install dependencies
php composer.phar install --no-dev -o
```

If composer fails to install the proper dependencies due to your PHP version, delete `composer.lock`
and try installing the dependencies again.

```bash
rm composer.lock
php composer.phar install --no-dev -o
```

## Running Shorty on...

### Apache

To run Shorty on Apache, you will need to create a new Apache configuration file in your operating system's Apache configuration folder (e.g `/etc/apache2/sites-enabled` or `/etc/httpd/sites-enabled`) or add a virtual host to your `httpd-vhosts.conf` file like so:

Replace `example.com` with your server's external address and restart Apache when done.

```apache
<VirtualHost *:80>
    ServerName example.com
    ServerAlias example.com

    DocumentRoot "/var/www/shorty/public"
    <Directory "/var/www/shorty/public">
        Require all granted
        Options Indexes FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

If `mod_rewrite` is not already enabled, you will need to enable it like so:

```bash
# enable mod_rewrite
a2enmod rewrite
# restart apache on Ubuntu
# sudo service apache2 restart

# restart apache on Fedora/CentOS
# sudo service httpd restart
```
### nginx

Replace `example.com` with your server's external address. You will need to install `php5-fpm`:

```
$ sudo apt-get install php-fpm
```

Useful LEMP installation tutorial by [DigitalOcean](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04)

```nginx
# Upstream to abstract backend connection(s) for php
upstream php {
    server unix:/var/run/php-fpm.sock;
    server 127.0.0.1:9000;
}

# HTTP

server {
    listen       *:80;
    root         /var/www/shorty/public;
    index        index.php index.html index.htm;
    server_name  example.com; # Or whatever you want to use

#   return 301 https://$server_name$request_uri; # Forces HTTPS, which enables privacy for login credentials.
                                                 # Recommended for public, internet-facing, websites.

    location / {
            try_files $uri $uri/ /index.php$is_args$args;
            # rewrite ^/([a-zA-Z0-9]+)/?$ /index.php?$1;
    }

    location ~ \.php$ {
            try_files $uri =404;
            include /etc/nginx/fastcgi_params;

            fastcgi_pass    php;
            fastcgi_index   index.php;
            fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param   HTTP_HOST       $server_name;
    }
}


# HTTPS

#server {
#   listen              *:443 ssl;
#   ssl_certificate     /etc/ssl/my.crt;
#   ssl_certificate_key /etc/ssl/private/my.key;
#   root                /var/www/shorty/public;
#   index index.php index.html index.htm;
#   server_name         example.com;
#
#   location / {
#           try_files $uri $uri/ /index.php$is_args$args;
#           # rewrite ^/([a-zA-Z0-9]+)/?$ /index.php?$1;
#   }
#
#   location ~ \.php$ {
#           try_files $uri =404;
#           include /etc/nginx/fastcgi_params;
#
#           fastcgi_pass    php;
#           fastcgi_index   index.php;
#           fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
#           fastcgi_param   HTTP_HOST       $server_name;
#   }
#}
```
### Shared hosting/other

To run Shorty on another HTTP server or on shared hosting, you will need to set the home
directory to `/PATH_TO_SHORTY/public`, not the root Shorty folder.

## Create the database

### MySQL

You must create a database for Shorty to use before you can complete the setup script.
To create a database for Shorty, you can log onto your `mysql` shell and run the following command:

```sql
CREATE DATABASE shortydatabasename;
```

Remember this database name, as you will need to provide it to Shorty during setup.
Additionally, if you wish to create a new user with access to solely this database, please look into MySQL's [GRANT](https://dev.mysql.com/doc/refman/5.7/en/grant.html) directive.

### SQLite

You may also use SQLite in place of MySQL for Shorty. However, SQLite is not recommended for use with Shorty.


## Option 1: Run the automatic setup script

Once your server is properly set up, you will need to configure Shorty and
enable it to access the database.

Copy the `.env.setup` file to `.env` in your website's root directory.

`$ cp .env.setup .env`

Then, head over to your new Shorty instance, at the path `/setup/` to configure
your instance with the correct information. (e.g example.com/setup)

This will automatically create the necessary tables and write a new configuration file to disk, `.env`. You may make changes  to your configuration later by editing this file.

Once the setup script is completed, Shorty is ready to go. You may go back to your Shorty homepage and log in to perform
any other actions.

## Option 2: Write the configuration file and create the tables manually

If you wish to configure and initialize Shorty manually, you may do so through command line, although it is not recommended.

Copy `resources/views/env.blade.php` to `.env` at the root directory
and update the values appropriately. Do not leave any curly braces in your new `.env`. You may leave
certain sections blank or commented-out to use the defaults.

You may then run the following `artisan` command to create the necessary tables:

```bash
php artisan migrate --force
php artisan geoip:update
```

You will also need to insert a admin user into the `users` table through `mysql` or a graphical SQL interface.
