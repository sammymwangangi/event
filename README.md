
## EVENT

### Event Management System.

## INSTALLATION

### 1. ```git clone https://github.com/sammymwangangi/event```
### 2. ```composer install```
### 3. ```php artisan key:generate```
### 4. ```cp .env.example .env```   \\\On windows machine use "copy" command instead of "cp".
#### 5. Edit/configure .env to match your database credentials
### 6. ```php artisan migrate --seed```
#### 7 If you run into any error edit ```app\Providers\AppServiceProvider.php```  by commenting this lines of code:
```
    public function boot()
    {
        //View::share('events', Event::all());
        //View::share('venues', Venue::all());
        //View::share('services', Service::all());
        //View::share('categories', Category::all());
    }
```
#### 8. After commenting repeat process #6 and uncomment them.
### 9. ```php artisan storage:link```
### 10. ```npm install```
### 11. `npm run dev`
### 12.` php artisan serve`
