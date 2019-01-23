FROM php:7.0-apache
COPY . /var/www/html/
RUN usermod -u 1000 www-data
EXPOSE 80