Laravel Version  12.36.1
PHP Version  8.4.1

docker compose up -d --build

composer create-project laravel/laravel .
npm install

npm run dev
php artisan key:generate
php artisan migrate

npm install && npm run build

docker stop laravel_app laravel_web laravel_phpmyadmin laravel_mysql
docker rm -v laravel_app laravel_web laravel_phpmyadmin laravel_mysql


http://localhost:8000/

---

docker exec -it laravel_app /bin/bash

artisan make:seeder AdminUserSeeder
hp artisan db:seed

Username: admin@example.com
Password: secret123

phpmyadmin
http://localhost:8080/
Username: laravel
Password: secret123

php artisan make:model Car -m
php artisan make:model Part -m
php artisan migrate

npm install bootstrap
npm run build
npm run dev
npm run watch

php artisan serve --host=127.0.0.1 --port=8888

---

php artisan serve --host=127.0.0.1 --port=8888


