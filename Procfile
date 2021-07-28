web: vendor/bin/heroku-php-apache2 public/
worker: supervisord -c /app/supervisor.conf -n
supervisor: supervisord -c supervisor.conf -n
worker2: php artisan queue:work redis --sleep=3 --daemon