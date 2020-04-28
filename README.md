### Login Page
![Signin Page](https://1.bp.blogspot.com/-g-95wmvU7ac/XqLfls8-REI/AAAAAAAAThg/_U8oSPVZMKEgls8NN16oq55PzqraWD0-ACLcBGAsYHQ/s640/signin.PNG)

### NVQ Level Page
![NVQ Levels](https://1.bp.blogspot.com/-BNdN31H6PMg/XqLgRxi3ITI/AAAAAAAATho/U22qMfxYtdM8NKUeftfpf25AkKquqw5uACLcBGAsYHQ/s1600/nvq.PNG)

### TVEC Exams Summary
![TVEC Exams Summary](https://1.bp.blogspot.com/-ltqS-Stqqws/XqLg0v_DplI/AAAAAAAAThw/2Nt9nF6WJwUdL-Hnfs2xfYflNx029inSACLcBGAsYHQ/s1600/TVEC%2BExams.PNG)

![Batch Result Sheet](https://4.bp.blogspot.com/-tWfhYQYXoCY/XqLiUnNNBkI/AAAAAAAATh8/JnvwztkKpsEGvJTjJozgd0M4v3fGWI7zwCLcBGAsYHQ/s1600/sheet.PNG)

## Setup a Examination Result Management System Laravel Project 
### Clone GitHub repo for this project locally

### Install Composer Dependencies
`composer install`

### Install NPM Dependencies
`npm install`

### Create a copy of your .env file
`cp .env.example .env`

### Generate an app encryption key
`php artisan key:generate`

### Create an empty database for our application
In the .env file, add database information to allow Laravel to connect to the database
In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.

### Migrate the database
`php artisan migrate`

### Seed the database
`php artisan db:seed`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
