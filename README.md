###Clone GitHub repo for this project locally

###Install Composer Dependencies
`composer install`

###Install NPM Dependencies
`npm install`

###Create a copy of your .env file
`cp .env.example .env`

###Generate an app encryption key
`php artisan key:generate`

###Create an empty database for our application
In the .env file, add database information to allow Laravel to connect to the database
In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.

###Migrate the database
`php artisan migrate`

###Seed the database
`php artisan db:seed`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
