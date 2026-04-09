# Mada Voyage - Plateforme Touristique Madagascar

Découvrez Madagascar à travers des circuits authentiques et des expériences inoubliables.

## 🌍 À Propos

Mada Voyage est une plateforme web modèle pour réserver des circuits touristiques à Madagascar. Le site est:
- ✅ **Dynamique** - Contenu géré via base de données
- ✅ **Production-Ready** - Optimisé pour le déploiement
- ✅ **Mobile-First** - Entièrement responsive sur tous les appareils
- ✅ **Sécurisé** - Headers de sécurité, protection des fichiers sensibles
- ✅ **Performant** - Gzip, cache, optimisé pour les images

## 🚀 Démarrage Rapide

### Installation Locale (Développement)

```bash
# 1. Cloner/extraire le projet
cd madavoyage

# 2. Exécuter le script de setup
bash setup.sh

# 3. Configurer la base de données
# Éditer .env avec vos paramètres MySQL
nano .env

# 4. Créer la base de données
mysql -u root
CREATE DATABASE madavoyage_dev;
EXIT;

# 5. Importer les données
mysql -u root madavoyage_dev < donnees.sql

# 6. Lancer le serveur de développement
php -S localhost:8000

# 7. Ouvrir dans le navigateur
# http://localhost:8000
```

### Déploiement Production

Voir [DEPLOYMENT.md](DEPLOYMENT.md) pour les instructions complètes.

Résumé rapide:
```bash
# 1. Permissions
chmod 755 public/assets/images
chmod 755 logs

# 2. Configuration
cp .env.example .env
nano .env  # Configurer pour production

# 3. Modules Apache
a2enmod rewrite
a2enmod ssl
a2enmod headers

# 4. Certificat SSL (Let's Encrypt)
certbot certonly --apache -d yourdomain.com

# 5. Redémarrer Apache
systemctl restart apache2
```

## 📁 Structure du Projet

```
madavoyage/
├── app/
│   ├── controller/          # Contrôleurs (logique métier)
│   │   ├── HomeController.php
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   └── ...
│   ├── model/
│   │   └── database.php     # Connexion BD
│   └── middleware/
│       └── auth.php          # Authentification
├── config/
│   └── Config.php           # Configuration centralisée
├── core/
│   └── route.php            # Système de routage
├── public/
│   └── assets/
│       ├── css/
│       │   ├── bootstrap.min.css
│       │   ├── style.css      # CSS custom
│       │   └── responsive.css # CSS responsive
│       ├── js/
│       └── images/
├── view/
│   ├── home/                # Pages publiques
│   ├── admin/               # Pages admin
│   ├── auth/                # Pages authentification
│   ├── error/               # Pages d'erreur
│   └── layout/              # Layout principal
├── logs/                    # Fichiers logs (créé au déploiement)
├── index.php               # Point d'entrée
├── .env.example            # Template config
├── .htaccess               # Configuration Apache
├── robots.txt              # SEO
├── DEPLOYMENT.md           # Docs déploiement
├── PRODUCTION_READY.md     # Infos production
└── README.md              # Ce fichier
```

## 🔧 Technologies

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+ / MariaDB
- **Frontend**: Bootstrap 5, Animate.css, FontAwesome
- **Security**: PDO prepared statements, input sanitization, security headers
- **Responsive**: Mobile-first CSS avec breakpoints

## 🔐 Sécurité

### Fichiers Protégés
```
.env          - Bloqué
config/       - Bloqué
logs/         - Bloqué
.sql files    - Bloqués
```

### Headers HTTP
```
X-Frame-Options: SAMEORIGIN           (Clickjacking protection)
X-Content-Type-Options: nosniff       (MIME sniffing protection)
X-XSS-Protection: 1; mode=block       (XSS protection)
Strict-Transport-Security: ...          (HSTS - HTTPS only)
```

### Validation Input
- Controller/action sanitization
- Path traversal protection
- MIME type validation pour upload
- Prepared statements pour BD

## 📱 Responsive Design

Le site est entièrement responsive:

| Taille | Device | Breakpoint |
|--------|--------|-----------|
| 320px | iPhone SE | < 768px |
| 375px | iPhone 12 | < 768px |
| 768px | iPad | 768-1024px |
| 1024px | iPad Pro | 768-1024px |
| 1440px | Desktop | > 1024px |

Fichier CSS: `public/assets/css/responsive.css`

Test: 
```
Chrome DevTools > Toggle Device Toolbar (Ctrl+Shift+M)
```

## 📊 Administration

### Accès Admin

1. Se connecter avec un compte admin
2. Cliquer sur "Administration" dans navbar
3. Gérer:
   - Circuits - Ajouter/éditer/supprimer
   - Équipes - Gestion des guides
   - Utilisateurs - Gestion des comptes
   - Réservations - Voir les bookings
   - Paiements - Historique
   - Messages - Requêtes clients

### Téléchargement Image

Tous les formulaires admin supportent:
- Upload local de fichiers
- URL externe
- Validation MIME type
- Stockage dans `public/assets/images/`

## 🗄️ Base de Données

### Tables Principales

```sql
users              -- Utilisateurs
admin              -- Comptes admin
circuits           -- Circuits touristiques
equipes            -- Guides/staff
reservations       -- Bookings clients
paiements          -- Transactions
messages           -- Contact form
login_history      -- Logs connexion
user_actions       -- Audit logs
```

### Créer la BD

```bash
mysql -u root -p < donnees.sql

# Ou manuellement:
mysql -u root -p
mysql> CREATE DATABASE madavoyage CHARACTER SET utf8mb4;
mysql> USE madavoyage;
mysql> SOURCE donnees.sql;
```

## 📝 Configuration (.env)

Clé configurations:

```env
# App
APP_ENV=production              # production ou development
APP_DEBUG=false                 # Afficher erreurs
APP_URL=https://madavoyage.com # URL site

# Database
DB_HOST=localhost              # Serveur MySQL
DB_PORT=3306                   # Port MySQL
DB_NAME=madavoyage            # Nom BD
DB_USER=madavoyage_user       # User MySQL
DB_PASS=SecurePassword123!    # Password MySQL

# Sécurité
SESSION_TIMEOUT=3600           # Durée session (secondes)
MAX_UPLOAD_SIZE=5242880       # Max 5MB

# Timezone
TIMEZONE=Indian/Antananarivo
```

Voir `.env.example` pour toutes les options.

## 🚀 Performance

### Optimisations Incluses
- Gzip compression (CSS, JS, HTML)
- Cache headers (Images: 1 an, CSS/JS: 1 mois)
- OPcache ready
- PDO connection pooling ready
- Minimal CSS footprint

### À Optimiser
```bash
# 1. Minify CSS/JS (optionnel)
# npm install -D cssnano terser
# npm run build

# 2. Image optimization
# mogrify -quality 85 public/assets/images/*.jpg

# 3. Setup CDN pour assets
# Servir public/assets/ via CDN
```

## 📊 Performance Monitoring

Endpoint santé:
```bash
curl https://yourdomain.com/health.php
```

Réponse si OK:
```json
{"status": "OK"}
```

## 🔄 Maintenance

### Logs
```bash
# Erreurs PHP
tail -f logs/$(date +%Y-%m-%d).log

# Erreurs Apache
tail -f /var/log/apache2/error.log
```

### Backups
Script fourni dans DEPLOYMENT.md:
```bash
# BD
mysqldump -u user -p database > backup.sql

# Fichiers
tar -czf backup.tar.gz app/ public/ view/
```

## 🐛 Troubleshooting

### Erreur 500
1. Vérifier `logs/` pour messages d'erreur
2. Vérifier permissions des dossiers
3. Vérifier connexion BD (.env)

### Images non affichées
1. Vérifier permissions: `chmod 755 public/assets/images/`
2. Vérifier chemin relatif dans BD
3. Vérifier existence fichier

### Page blanche
1. Activer APP_DEBUG=true temporairement
2. Vérifier logs Apache
3. Vérifier syntaxe PHP: `php -l index.php`

## 📖 Documentation

- [DEPLOYMENT.md](DEPLOYMENT.md) - Guide déploiement production
- [PRODUCTION_READY.md](PRODUCTION_READY.md) - Statut production
- [DOCKER_README.md](DOCKER_README.md) - Docker setup (optionnel)

## 🎨 Personnalisation

### Logo
Remplacer: `public/assets/images/logo-madavoyage.png`

### Couleurs
Fichier: `public/assets/css/style.css`
```css
.primary-color {
    color: #0277bd;  /* Modifier ici */
}
```

### Texte
Structure MVC permet d'éditer facilement.
- Controllers: `app/controller/`
- Views: `view/`

## 📞 Support

Pour problèmes:
1. Consulter [DEPLOYMENT.md](DEPLOYMENT.md)
2. Vérifier logs
3. Tester avec `php -l`

## 📜 Licence

À définir

## 👥 Auteurs

Équipe Mada Voyage

---

**Dernière mise à jour**: 2024  
**Version**: 1.0  
**Statut**: Production-Ready ✅
