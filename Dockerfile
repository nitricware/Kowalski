FROM php:7.4-apache
COPY . /var/www/html/
RUN usermod -u 1000 www-data
EXPOSE 80