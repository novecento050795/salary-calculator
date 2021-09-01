## project instalation
1) git clone https://github.com/novecento050795/salary-calculator.git /clone repository
2) open project in terminal 
3) composer install /install dependencies
4) create .env file from .env.example
5) configure db connection in .env
6) php artisan key:generate /genereta APP_KEY
7) php artisan migrate /store tables to db
8) php artisan serve start project

## Route list
/api/calculate - GET
/api/store - POST