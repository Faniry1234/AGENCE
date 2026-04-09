# Mada Voyage - Docker Setup

## Prérequis
- Docker installé
- Docker Compose installé

## Installation et Lancement

### 1. Démarrer les conteneurs
```bash
docker-compose up -d
```

### 2. Accéder à l'application
- **Site web**: http://localhost
- **Base de données MySQL**: localhost:3306

### 3. Identifiants MySQL
- **User**: root
- **Password**: root
- **Database**: madavoyage

## Commandes utiles

### Voir les logs
```bash
docker-compose logs -f web
docker-compose logs -f db
```

### Accéder au shell PHP
```bash
docker-compose exec web bash
```

### Accéder à MySQL
```bash
docker-compose exec db mysql -u root -p madavoyage
```

### Arrêter les conteneurs
```bash
docker-compose down
```

### Reconstruire les images
```bash
docker-compose up -d --build
```

## Structure Docker

### Service `web` (PHP + Apache)
- Image: PHP 8.2 avec Apache
- Port: 80 (local) → 80 (conteneur)
- Volume: Code du projet monté en live

### Service `db` (MySQL)
- Image: MySQL 8.0
- Port: 3306 (local) → 3306 (conteneur)
- Volume: Base de données persistante

## Configuration

Les variables d'environnement peuvent être modifiées dans `docker-compose.yml`:
- `MYSQL_ROOT_PASSWORD`: Mot de passe MySQL
- `MYSQL_DATABASE`: Nom de la base de données
- Ports à mapper

## Troubleshooting

### Port 80 déjà utilisé
Modifier dans `docker-compose.yml`:
```yaml
ports:
  - "8080:80"  # Accès: http://localhost:8080
```

### MySQL ne démarre pas
```bash
docker-compose down -v  # Supprime les volumes
docker-compose up -d    # Redémarre
```

### Réinitialiser la base de données
```bash
docker-compose down -v
docker-compose up -d
```
