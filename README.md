## Step by Step

1. Make sure your machine has already meet the requirements in the [Laravel Server Requirement] (https://laravel.com/docs/10.x/deployment#server-requirements) with MySQL Database and Composer.

2. Clone this project using:

```bash
git clone https://github.com/marbonka/mbk-timedoor-assessment.git
```
3. Go to this root project folder and install the required composer package

```bash
composer install
```

4. After installation is done, please check if you have .env already or not. If you don't have one please create one according to your machine configuration,

5. Make sure you are configured the correct database setup in your machine operating system, and in your .env file also.

6. Run the migration with seed option (seed option required to populate data to database) command in the root project folder

```bash
php artisan migrate:fresh --seed
```

7. Run the artisan serve to test run this project in the frontend

```bash
php artisan serve
```

8. Open the domain and the port (you can also configured different port with --port=port_number option) in the browser

## Thank You Notes

Thank you to Timedoor Team, HR Department for giving me the opportunity to work on this project.
