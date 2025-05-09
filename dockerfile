FROM php:8.2-apache

# Enable mod_rewrite for .htaccess support
RUN a2enmod rewrite

# Set AllowOverride to All in Apache config
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Install PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable PHP error logging
RUN echo "log_errors = On" >> /usr/local/etc/php/conf.d/error-logging.ini \
    && echo "error_log = /var/log/php_errors.log" >> /usr/local/etc/php/conf.d/error-logging.ini \
    && touch /var/log/php_errors.log \
    && chmod 777 /var/log/php_errors.log

# Ensure Apache logs are accessible
RUN mkdir -p /var/log/apache2 && chmod -R 777 /var/log/apache2

# # Restart Apache
CMD ["apache2-foreground"]
