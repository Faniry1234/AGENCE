# Guide de Déploiement - Mada Voyage

## Table des matières
1. [Prérequis](#prérequis)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Base de données](#base-de-données)
5. [Sécurité](#sécurité)
6. [Optimisation](#optimisation)
7. [Maintenance](#maintenance)
8. [Troubleshooting](#troubleshooting)

## Prérequis

### Serveur
- PHP 7.4+ (recommandé 8.0+)
- MySQL/MariaDB 5.7+ ou PostgreSQL
- Apache 2.4+ avec mod_rewrite activé
- OpenSSL pour HTTPS

### Extensions PHP nécessaires
```bash
# Vérifier les extensions
php -m | grep -E '(gd|mbstring|pdo|mysql|json)'
```

Vérifier que les extensions suivantes sont présentes:
- `pdo_mysql` - Connexion base de données
- `gd` - Traitement d'images
- `mbstring` - Encodage UTF-8
- `json` - Support JSON
- `fileinfo` - Détection MIME

## Installation

### 1. Télécharger les fichiers

```bash
# Cloner ou extraire les fichiers
cd /var/www/html
git clone <repository-url> madavoyage
cd madavoyage
```

### 2. Définir les permissions

```bash
# Permissions pour Apache
sudo chown -R www-data:www-data /var/www/html/madavoyage
sudo chmod 755 /var/www/html/madavoyage
sudo chmod 755 public/assets/images
sudo chmod 755 public/assets/uploads
sudo chmod 755 logs
```

### 3. Installer les dépendances (si Composer est utilisé)

```bash
composer install --optimize-autoloader --no-dev
```

## Configuration

### 1. Créer le fichier .env

```bash
# Depuis la racine du projet
cp .env.example .env
nano .env
```

### 2. Configurer les variables (exemple)

```env
APP_NAME=Mada Voyage
APP_ENV=production
APP_DEBUG=false
APP_URL=https://madavoyage.com

DB_HOST=localhost
DB_PORT=3306
DB_NAME=madavoyage_prod
DB_USER=madavoyage_user
DB_PASS=SecurePassword123!

TIMEZONE=Indian/Antananarivo
MAX_UPLOAD_SIZE=5242880

LOG_PATH=/var/log/madavoyage/
```

### 3. Configurer Apache

Créer un VirtualHost:

```apache
<VirtualHost *:80>
    ServerName madavoyage.com
    ServerAlias www.madavoyage.com
    DocumentRoot /var/www/html/madavoyage/public
    
    <Directory /var/www/html/madavoyage>
        AllowOverride All
        Require all granted
    </Directory>
    
    # Redirection HTTP vers HTTPS
    Redirect permanent / https://madavoyage.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName madavoyage.com
    ServerAlias www.madavoyage.com
    DocumentRoot /var/www/html/madavoyage/public
    
    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/your-cert.crt
    SSLCertificateKeyFile /etc/ssl/private/your-key.key
    SSLCertificateChainFile /etc/ssl/certs/chain.crt
    
    <Directory /var/www/html/madavoyage>
        AllowOverride All
        Require all granted
    </Directory>
    
    # Security headers
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-XSS-Protection "1; mode=block"
</VirtualHost>
```

Activer le VirtualHost:
```bash
sudo a2ensite madavoyage
sudo a2enmod rewrite
sudo a2enmod ssl
sudo a2enmod headers
sudo systemctl restart apache2
```

## Base de données

### 1. Créer l'utilisateur et la base de données

```sql
-- Créer l'utilisateur
CREATE USER 'madavoyage_user'@'localhost' IDENTIFIED BY 'SecurePassword123!';

-- Créer la base de données
CREATE DATABASE madavoyage_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Accorder les permissions
GRANT ALL PRIVILEGES ON madavoyage_prod.* TO 'madavoyage_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2. Importer les schémas

```bash
# Exécuter le script de setup
mysql -u madavoyage_user -p madavoyage_prod < setup_database.php

# Ou importer manuellement les données initiales
mysql -u madavoyage_user -p madavoyage_prod < donnees.sql
```

### 3. Vérifier la connexion

```bash
# Tester la connexion
mysql -u madavoyage_user -p -h localhost -e "SELECT 1;"
```

## Sécurité

### 1. Protéger les fichiers sensibles

Le fichier `.htaccess` protège automatiquement:
- Le dossier `/config`
- Le dossier `/logs`
- Les fichiers `.env`
- Les fichiers `.sql`

Vérifier la protection:
```bash
curl -I https://madavoyage.com/config/Config.php  # Devrait retourner 403
```

### 2. Configurer le HTTPS

Utiliser Let's Encrypt:
```bash
sudo certbot certonly --apache -d madavoyage.com -d www.madavoyage.com
```

### 3. Activer le HSTS (HTTP Strict Transport Security)

Déjà configuré dans `.htaccess` pour 1 an.

### 4. Configuration PHP sécurisée

Créer ou modifier `.user.ini`:

```ini
; Sécurité de base
display_errors = Off
display_startup_errors = Off
log_errors = On
error_log = /var/log/madavoyage/error.log

; Sessions
session.use_strict_mode = 1
session.cookie_httponly = 1
session.cookie_secure = 1
session.cookie_samesite = Strict

; Upload
upload_max_filesize = 10M
post_max_size = 10M
max_file_uploads = 5

; Performances
opcache.enable = 1
opcache.memory_consumption = 128
realpath_cache_size = 4096K
```

## Optimisation

### 1. Activer OPcache

Vérifier que OPcache est activé:
```bash
php -i | grep opcache
```

Si désactivé, ajouter à php.ini:
```ini
[opcache]
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

### 2. Activer Gzip

Déjà configuré dans `.htaccess`.

Vérifier:
```bash
curl -I -H "Accept-Encoding: gzip" https://madavoyage.com | grep Content-Encoding
```

### 3. Optimisation CSS/JS

Minifier et combiner les fichiers CSS/JS.

### 4. Optimisation des images

```bash
# Installer ImageMagick
sudo apt-get install -y imagemagick

# Optimiser les images existantes
mogrify -quality 85 public/assets/images/*.jpg
```

### 5. CDN pour les assets statiques

Configurer un CDN pour `public/assets/images/`.

## Maintenance

### 1. Sauvegardes quotidiennes

```bash
#!/bin/bash
# backup.sh

BACKUP_DIR="/backups/madavoyage"
DB_NAME="madavoyage_prod"
DB_USER="madavoyage_user"
DATE=$(date +%Y%m%d_%H%M%S)

# Sauvegarde BD
mysqldump -u $DB_USER -p $DB_NAME > $BACKUP_DIR/db_$DATE.sql

# Sauvegarde fichiers
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/html/madavoyage

# Nettoyer les vieilles sauvegardes (> 30 jours)
find $BACKUP_DIR -type f -mtime +30 -delete
```

Ajouter à crontab:
```bash
0 2 * * * /var/www/html/madavoyage/backup.sh > /var/log/madavoyage/backup.log 2>&1
```

### 2. Monitoring des logs

```bash
# Suivre les erreurs en temps réel
tail -f /var/log/madavoyage/error.log

# Analyser les erreurs
grep ERROR /var/log/madavoyage/error.log | tail -20
```

### 3. Contrôle de santé

Créer un script de vérification:

```php
// public/health.php
<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=madavoyage_prod',
        'madavoyage_user',
        getenv('DB_PASS')
    );
    
    // Test de la base de données
    $pdo->query('SELECT 1');
    
    // Vérifier les permissions des répertoires
    $dirs = [
        'public/assets/images',
        'public/assets/uploads',
        'logs'
    ];
    
    foreach ($dirs as $dir) {
        if (!is_writable($dir)) {
            throw new Exception("Directory not writable: $dir");
        }
    }
    
    echo json_encode(['status' => 'OK']);
    http_response_code(200);
} catch (Exception $e) {
    echo json_encode(['status' => 'ERROR', 'message' => $e->getMessage()]);
    http_response_code(503);
}
?>
```

Tester:
```bash
curl https://madavoyage.com/health.php
```

## Troubleshooting

### Erreur: "500 Internal Server Error"

1. Vérifier les logs Apache:
```bash
tail -f /var/log/apache2/error.log
```

2. Vérifier l'activation de mod_rewrite:
```bash
apache2ctl -M | grep rewrite
```

3. Vérifier les permissions:
```bash
ls -la /var/www/html/madavoyage/
```

### Problème de connexion BD

1. Tester avec mysql-cli:
```bash
mysql -u madavoyage_user -p -h localhost madavoyage_prod -e "SELECT 1;"
```

2. Vérifier les paramètres dans `.env`

3. Vérifier les logs PHP:
```bash
tail -f /var/log/php-fpm.log
```

### Problème d'upload d'image

1. Vérifier les permissions du répertoire:
```bash
ls -la public/assets/images/
chmod 755 public/assets/images/
```

2. Vérifier le `max_upload_size` dans PHP:
```bash
php -r "echo ini_get('upload_max_filesize') . PHP_EOL;"
```

3. Vérifier les extensions MIME:
```bash
php -i | grep fileinfo
```

## Support

Pour toute question ou problème:
1. Vérifier les logs: `/var/log/madavoyage/`
2. Consulter la documentation: `/DEPLOYMENT.md`
3. Contacter le support technique
