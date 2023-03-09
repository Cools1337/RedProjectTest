## Backend

<a name="technologies"><h2>Используемые технологии и инструменты</h2></a>

1. PHP
2. Laravel, Backpack

<a name="deployment"><h2>Разворачивание бэка проекта</h2></a>

1. Создаем postgresql базу данных red_project_test с пользователем red_project_test

CREATE USER "red_project_test" WITH PASSWORD 'red_project_test';<br>
CREATE DATABASE "red_project_test" WITH OWNER = "red_project_test";

1.1 При необходимости загружаем дамп базы

2. Копируем .env.example в .env

3. Прописываем настройки подключения к базе данных

DB_CONNECTION=pgsql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=5432<br>
DB_DATABASE=red_project_test<br>
DB_USERNAME=red_project_test<br>
DB_PASSWORD=red_project_test

4. Устанавливаем зависимости

composer install

5. Генерируем ключ

php artisan key:generate

6. Делаем ссылку на Storage

php artisan storage:link

7. Разворачиваем миграции

php artisan migrate

8. Запускаем

php artisan serve

## Frontend

<a name="deployment"><h2>Разворачивание фронта проекта</h2></a>

1. Установим зависимости

npm install 

2. Запускаем npm

npm run dev
