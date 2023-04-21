# CommentSold Code Test

## Install Laravel and push to Github 
```
composer create-project laravel/laravel code-test
cd code-test/
git init
git branch -M main
git remote add origin git@github.com:abrahambosch/commentsold-code-test.git
git add -A
git commit -m "Initial Laravel Install"
git push -u origin main
```


## Install Laravel Sail
```
composer require laravel/sail --dev
php artisan sail:install
./vendor/bin/sail up
```


## Install Laravel Breeze
```
php artisan breeze:install
composer require laravel/breeze --dev
php artisan breeze:install vue
sail php artisan migrate
npm install
npm run dev
```


## Scaffold out the Models, Migrations, and Contoller Resources. 
```
sail php artisan make:migration additional_user_fields
sail php artisan make:seeder UserSeeder
sail php artisan make:model --controller --resource --migration --seed Product
sail php artisan make:model --controller --resource --migration --seed InventoryItem
sail php artisan make:model --controller --resource --migration --seed Order

```

## Connect to database
```
docker compose exec mysql mysql laravel -u sail -ppassword

```

## Current User Table
 - mysql> show create table users
```
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci  
```

## run migrations
```
sail php artisan migrate
sail php artisan migrate:rollback
```


## Seeding the database
```
php artisan db:seed --class=UserSeeder
sail php artisan db:seed --class=ProductSeeder
sail php artisan db:seed --class=InventoryItemSeeder
sail php artisan db:seed --class=OrderSeeder
```



