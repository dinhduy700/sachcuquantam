# sachcuquantam

## Installation

### Requirements
For system requirements you check [Laravel Requirement](https://laravel.com/docs/8.x/deployment#server-requirements)

### 1 - Clone the repository.
Clone repo for this project locally
`git clone https://github.com/duynguyen3009/sachcuquantam.git`

### 2 - Install Composer Dependencies.
Open your terminal and run this command
```sh
cd sachcuaquantam
composer install
```

### 3 - Config file & Generate an app encryption key.
Rename or copy `.env.example` file to `.env`
```sh
cp .env.example .env
php artisan key:generate
```

### 4 - Create a Database
1. Migrate database table
`php artisan migrate`
2. Generate config
`php artisan db:seed`

### 5 - Run Server
1. `php artisan serve` or Laravel Homestead
2. Visit `localhost:8000` in browser

### 6 - Create storage
`php artisan storage:link`
