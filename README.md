
## EVENT

#### Event Management System. (SYSTEM STILL UNDER EARLY STAGES OF DEVELEOPMENT)

## FEATURES

* **These are the features that are going to be in the final piece of the project.**

    * `Book events, venues and services. (COMING SOON)`
    * `Track Income and expenses.` 
        > `INCOME` is accumulated when people buy tickets for your event, or book your venue or service. `EXPENSES` occur when you book venues and/or services for your event.              (COMING SOON)
    * `Payments Integration. (COMING SOON)`
    * `Admin Dashboard to manage all users, event organizers, event owners, venue owners, services providers and general settings of the system. (COMING SOON)`
    * `Integrate VueJs for super UX (COMING SOON)`
    * `PostgreSQL for faster database queries. ( ALREADY CONFIQURED)`

## INSTALLATION

### 1. `git clone https://github.com/sammymwangangi/event`
### 2. `composer install`
### 3. `php artisan key:generate`
### 4. `cp .env.example .env`
    > On windows machine use "copy" command instead of "cp".
#### 5. Edit/configure .env to match your database credentials. I have used `POSTGRESQL`.
### 6. `php artisan migrate --seed`
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
