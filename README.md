1. git clone https://github.com/semailk/laravel-vue.git
2. cd laravel-vue/back-end/
3. composer install 
4. cp .env.example .env
5. Настраиваем .env файл (mysql)
6. php artisan key:generate
7. php artisan optimize
8. php artisan migrate --seed
9. cd ../front-end/
10. npm i && npm run build
11. npm run serve