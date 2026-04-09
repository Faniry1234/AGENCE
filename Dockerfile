# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activer mod_rewrite pour les URL propres
RUN a2enmod rewrite

# Configurer Apache pour accepter .htaccess
RUN sed -i 's/<Directory \/var\/www\/html>/<Directory \/var\/www\/html>\n    AllowOverride All/' /etc/apache2/apache2.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . /var/www/html/

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
