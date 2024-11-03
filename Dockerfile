# Use the official PHP image from the Docker Hub
FROM php:8.0-apache

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Install any necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql
