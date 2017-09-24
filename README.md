# Employee admin panel

### Include ###

* [Laravel 5.5](http://laravel.com) for front architecture
* [Bootstrap 4](http://getbootstrap.com) for CSS and jQuery plugins
* [Vue](https://vuejs.org/) as JS framework

### Features ###

* Login page
* Employee page which is available only for logged in users
* Address validation with Google Maps API
* REST API endpoints to perform CRUD employee operations
* Console command to create new admin users
* Password hashing for admin user
* Unit and functional tests


### Installation ###
https://github.com/CuriousVit/laravel_employee_admin.git
* `git clone https://github.com/CuriousVit/laravel_employee_admin.git`
* `cd laravel_employee_admin`
* `composer install`
* `npm install`
* `php artisan key:generate`
* Create a database and inform *.env*
* `php artisan migrate --seed` to create and populate tables
* `php artisan serve` to start the app on http://localhost:8000/

### To run tests: ###
`./vendor/bin/phpunit`