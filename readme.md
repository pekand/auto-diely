# Car parts

Demo application for a technical interview: a simple car and parts inventory system.

## Overview

"Car parts" is a small demo app to track cars and their parts. It includes user authentication, a list of cars, and a list arts (each part belongs to a car). Intended as a portfolio / interview demo.

## Features


- Login / Authentication
- List, create, edit and delete Cars
- List, create, edit and delete Parts (linked to Cars)
- Simple responsive UI built with Bootstrap
- Runs in Docker containers with a MySQL database

## Tech stack

- Backend: Laravel (PHP) Laravel Version  12.36.1
- PHP Version  8.4.1
- Frontend: Vue.js
- Styling: Bootstrap
- Database: MySQL
- Dev / runtime: Docker / Docker Compose

## Requirements

- Docker & Docker Compose

## Quick setup (Docker)


1. Clone the repository

```bash

git clone <repo-url>

cd auto-diely

```


2. Copy environment file and adjust settings


```bash

cp .env.example .env

# edit .env if needed (DB credentials are set for Docker Compose by default)

```


3. Start containers


```bash

docker compose up -d --build

```


4. Install dependencies and run migrations (inside app container)


```bash

# run commands inside the php/app container, for example:

docker compose exec app bash

composer install

php artisan key:generate

php artisan migrate --seed

npm install

npm run build

exit

```


5. Open the app in your browser


```text

[http://localhost:8000](http://localhost:8000)

```


## Environment / Database


The app uses MySQL. Default Docker Compose sets the following environment variables (adjust in .env or docker-compose.yml eeded):


- DB_CONNECTION=mysql

- DB_HOST=mysql

- DB_PORT=3306

- DB_DATABASE=laravel

- DB_USERNAME=laravel

- DB_PASSWORD=secret


## Project structure (high level)


- `app/` — Laravel backend code (models, controllers)

- `resources/js/` — Vue frontend components

- `resources/sass` or `resources/css` — Bootstrap styles and overrides

- `database/` — migrations and seeders

- `docker/` and `docker-compose.yml` — container setup


## Screenshots


*Placeholders — replace with your screenshots in the repo when ready:*


- `images/login.png` — Login page

- `images/cars-list.png` — Cars list

- `images/parts-list.png` — Parts list

- `images/create-car.png` — Create car form

- `images/create-part.png` — Create part form

- `images/edit-part.png` — Edit part form

- `images/dashboard.png` — Dashboard



## Common commands


- Build & start containers: `docker compose up -d --build`

- Stop containers: `docker compose down`

- Run artisan inside container: `docker compose exec app php artisan <cmd>`

- Run npm inside container: `docker compose exec app npm run dev` or `npm run build`


## Notes for interview/demo


- This is intentionally small and focused — highlight authentication flow, Eloquent relationships (Car -> Parts), and le CRUD UI.

- Point out the Docker setup that makes the app easy to run locally.


## Contributing


Feel free to open issues or submit pull requests. For small changes, follow this flow:


1. Fork the repo

2. Create a feature branch

3. Commit changes and push

4. Open a pull request describing the change


## License


Add your preferred license here (e.g. MIT).
