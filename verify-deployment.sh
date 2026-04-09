#!/bin/bash
# Mada Voyage - Deployment Verification Script

echo "🔍 Mada Voyage - Deployment Verification"
echo "========================================="
echo ""

check_file() {
    if [ -f "$1" ]; then
        echo "✓ $1"
        return 0
    else
        echo "✗ $1 (MISSING)"
        return 1
    fi
}

check_dir() {
    if [ -d "$1" ]; then
        echo "✓ $1/"
        return 0
    else
        echo "✗ $1/ (MISSING)"
        return 1
    fi
}

check_readable() {
    if [ -r "$1" ]; then
        echo "✓ $1 (readable)"
        return 0
    else
        echo "✗ $1 (NOT READABLE)"
        return 1
    fi
}

errors=0

echo "📄 Checking Essential Files..."
check_file "index.php" || ((errors++))
check_file ".htaccess" || ((errors++))
check_file ".env.example" || ((errors++))
check_file "robots.txt" || ((errors++))
check_file "config/Config.php" || ((errors++))
check_file "app/model/database.php" || ((errors++))

echo ""
echo "📁 Checking Essential Directories..."
check_dir "app/controller" || ((errors++))
check_dir "app/model" || ((errors++))
check_dir "public/assets" || ((errors++))
check_dir "view/home" || ((errors++))
check_dir "view/admin" || ((errors++))
check_dir "view/error" || ((errors++))

echo ""
echo "🎨 Checking CSS Files..."
check_file "public/assets/css/bootstrap.min.css" || ((errors++))
check_file "public/assets/css/style.css" || ((errors++))
check_file "public/assets/css/responsive.css" || ((errors++))

echo ""
echo "📚 Checking Documentation..."
check_file "README.md" || ((errors++))
check_file "DEPLOYMENT.md" || ((errors++))
check_file "PRODUCTION_READY.md" || ((errors++))

echo ""
echo "🔒 Checking File Permissions..."
check_readable "index.php" || ((errors++))
check_readable "config/Config.php" || ((errors++))

echo ""
echo "✓ Checking .env Setup..."
if [ -f ".env" ]; then
    echo "  ✓ .env exists"
else
    if [ -f ".env.example" ]; then
        echo "  ⚠️  .env not found (copy from .env.example)"
        ((errors++))
    fi
fi

echo ""
echo "📋 PHP Syntax Check..."
php_check=$(php -l index.php 2>&1)
if echo "$php_check" | grep -q "No syntax errors detected"; then
    echo "  ✓ index.php"
else
    echo "  ✗ index.php has errors"
    echo "$php_check"
    ((errors++))
fi

php_check=$(php -l config/Config.php 2>&1)
if echo "$php_check" | grep -q "No syntax errors detected"; then
    echo "  ✓ config/Config.php"
else
    echo "  ✗ config/Config.php has errors"
    echo "$php_check"
    ((errors++))
fi

echo ""
echo "========================================="

if [ $errors -eq 0 ]; then
    echo "✅ All checks passed!"
    echo ""
    echo "🚀 Next Steps:"
    echo "1. Copy .env.example to .env"
    echo "2. Edit .env with database credentials"
    echo "3. Create database and import schema"
    echo "4. Set directory permissions: chmod 755 public/assets/images logs"
    echo "5. Enable Apache modules: a2enmod rewrite ssl headers"
    echo "6. Configure SSL certificate"
    exit 0
else
    echo "❌ $errors errors found!"
    echo "Please fix the issues above."
    exit 1
fi
