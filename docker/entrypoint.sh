#!/bin/sh

if [ ! -f "vendor/autoload.php" ]; then

    echo "Running composer install"
    composer install --no-progress --no-interaction
else
    echo "Composer installed already"
fi

if [ ! -f ".env" ]; then
    echo "Creating env file"
    cp .env.example .env
else
    echo "Env exists already"
fi

# Wait for MySQL to be ready
while ! nc -z db 3306; do
  sleep 1
done

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

if [ "$env" != "local" ]; then

  echo "Caching configuration..."
  php artisan config:cache
  php artisan route:cache 
  php artisan view:cache
  echo "Done caching..."

else

  echo "Clear cache..."
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  echo "Done clearing cache"

fi

if [ "$role" = "app" ]; then

  echo "Run migrations..."
  php artisan migrate --force
  echo "Done Run migrations"
  echo "Generating key..."
  php artisan key:generate
  echo "Done generating key"

elif [ "$role" = "queue" ]; then

  echo "Running queue ... "
  php artisan queue:work --verbose --tries=3 --timeout=180

fi
# Start PHP-FPM
php-fpm