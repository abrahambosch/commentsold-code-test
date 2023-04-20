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
sail php artisan make:seeder UserSeeder
sail php artisan make:model --controller --resource --migration --seed Product
sail php artisan make:model --controller --resource --migration --seed InventoryItem
sail php artisan make:model --controller --resource --migration --seed Order

```




