- vendor/bin/phpunit

Se va in errore per transaction, prova :
- php artisan cache:clear
- php artisan config:clear

Check coverage:
- php vendor/bin/phpunit or php artisan test
- http-server reports/coverage/html 