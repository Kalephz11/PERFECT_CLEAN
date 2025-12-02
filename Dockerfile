FROM php:8.2-apache

# Copiar el proyecto al servidor Apache
COPY . /var/www/html/

# Activar mod_rewrite (opcional)
RUN a2enmod rewrite

# Puerto del servidor
EXPOSE 80
