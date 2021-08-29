# school System  package 

## 1.before install school Razan package, require use this commands:

 composer require laravel/jetstream

##
 php artisan jetstream:install livewire

##
 composer require santigarcor/laratrust
## 
 php artisan vendor:publish --tag="laratrust-seeder"
## 
 php artisan laratrust:setup
## 
 php artisan laratrust:seeder
 
## 2.
    composer require razan/school
## in config->app.php add to providers array 
       Razan\School\SchoolServiceProvider::class,
## then run in terminal: 
       php artisan vendor:publish --provider="Razan\School\SchoolServiceProvider"  
## in routes-> web.php edit:Route::group(['namespace'=>'Razan\School\Http\Livewire']
    Route::group(['namespace'=>'App\Http\Livewire']
## and app->http->livewire edit namespace from Razan\School\Http\Livewire to 
        App\Http\Livewire
 
## 3.In the database/seeds/DatabaseSeeder.php file 
  $this->call(LaratrustSeeder::class);
## 
  php artisan migrate
## 
  php artisan db:seed

## 4.
    npm install 
##   
    npm run dev
