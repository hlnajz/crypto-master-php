# Use the official PHP image as the base image
FROM php:8.1-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy the project files into the container's web directory
COPY . /var/www/html/

# Expose the port that Apache is running on (by default it's 80)
EXPOSE 80
