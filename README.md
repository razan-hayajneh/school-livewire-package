# school system package

## 1.before install school system package, require use this commands:

## composer require laravel/jetstream

## php artisan jetstream:install livewire

## composer require santigarcor/laratrust
## php artisan vendor:publish --tag="laratrust-seeder"
## php artisan laratrust:setup
## php artisan laratrust:seeder
 
## 2.composer require system/school
## in config->app.php add to providers array 
##       System\School\SchoolServiceProvider::class,
## then run in terminal: 
##       php artisan vendor:publish --provider="System\School\SchoolServiceProvider"  
## in routes-> web.php edit:
    Route::group(['namespace'=>'System\School\Http\Livewire']
    Route::group(['namespace'=>'App\Http\Livewire']
## and app->http->livewire edit namespace from System\School\Http\Livewire to App\Http\Livewire
 
## 3.In the database/seeds/DatabaseSeeder.php file 
## $this->call(LaratrustSeeder::class);
## php artisan migrate
## php artisan db:seed

## 4.npm install 
##   npm run dev
