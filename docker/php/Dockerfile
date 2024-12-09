FROM php:8.3-fpm

WORKDIR /var/www

# Switch to root user to install dependencies
USER root

# Install dependencies for PDO and MySQLi extensions using MariaDB client libraries
RUN apt-get update && apt-get install -y libmariadb-dev libzip-dev zip unzip git

# Install PDO, PDO_MySQL, and MySQLi extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Install Composer in the app container
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Fix ownership of /var/www
# RUN chown -R root:root /var/www

# Run the git config command
RUN git config --global --add safe.directory /var/www

# Set back to the default non-root user (optional, if needed)
# USER www-data

# Expose the application port
EXPOSE 80
