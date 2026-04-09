#!/bin/bash
# Mada Voyage - Quick Setup Script for Development
# Usage: bash setup.sh

set -e

echo "🚀 Mada Voyage - Setup Script"
echo "=============================="
echo ""

# Check PHP
echo "✓ Checking PHP..."
php_version=$(php -v | python3 -c "import sys; print(sys.stdin.read().split()[1])")
echo "  PHP Version: $php_version"

# Check required extensions
echo ""
echo "✓ Checking PHP Extensions..."
required_extensions=("pdo_mysql" "gd" "mbstring" "json" "curl")
for ext in "${required_extensions[@]}"; do
    if php -m | grep -q "^$ext\$"; then
        echo "  ✓ $ext"
    else
        echo "  ✗ $ext (MISSING)"
    fi
done

# Create .env if not exists
echo ""
echo "✓ Setting up .env..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "  Created .env from .env.example"
    echo "  ⚠️  Edit .env with your database credentials"
else
    echo "  .env already exists"
fi

# Create necessary directories
echo ""
echo "✓ Creating directories..."
mkdir -p logs
mkdir -p public/assets/uploads
mkdir -p -p public/assets/images
chmod 755 logs
chmod 755 public/assets/uploads
chmod 755 public/assets/images
echo "  Directories created"

# Check if we can connect to database
echo ""
echo "✓ Testing database connection..."
php -r "
    require_once 'config/Config.php';
    try {
        \$pdo = new PDO(
            'mysql:host=' . DB_HOST . ';port=' . DB_PORT,
            DB_USER,
            DB_PASS
        );
        echo '  ✓ Connected to MySQL server\\n';
    } catch (PDOException \$e) {
        echo '  ✗ Cannot connect to MySQL: ' . \$e->getMessage() . '\\n';
    }
" || echo "  Database check skipped"

echo ""
echo "✅ Setup Complete!"
echo ""
echo "📝 Next Steps:"
echo "1. Edit .env with your database credentials"
echo "2. Create database: CREATE DATABASE madavoyage_dev;"
echo "3. Import schema: mysql -u user -p madavoyage_dev < donnees.sql"
echo "4. Start development server: php -S localhost:8000"
echo "5. Visit: http://localhost:8000"
echo ""
