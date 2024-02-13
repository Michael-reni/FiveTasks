## Open laravel project in Visual Studio Code or some other IDE and copy .env.example to .env. You can customize some .env variables if you need. 
## Open a terminal and type:  
```
$ cd path/to/ThreeExercises
$ docker-compose --env-file ./laravel_project/laravel/.env up -d
$ docker exec -it nginx_three_tasks bash
$ cd app/laravel/
$ composer install
$ php artisan migrate
$ php artisan l5-swagger:generate
```
## Now you can access Swagger documentation. Copy Paste it to the browser "http://127.0.0.1:8089/api/documentation". You can validate all 3 tasks here.
## Unfortunately Swagger can't render HTML (the idea was rejected by dev's because of security), so to see results from task 1, copy that link to the browser: 
"http://127.0.0.1:8089/api/task1/2022/September", change last two parts of request query string (a year and a month) to change response result.
## To look inside database, you can access pgadmin in the browser "http://localhost:5559" (wait a while after you passed it to the browser, pg admin needs time to load), 
credentials are in .env file, but if you didn't change them, these should be default values:
```
login = email_pgadmin@pgadmin.org
password = secret_admin
```	
## To connect with database: Rigth Click On Serwer->register->serwer->connection
```
hotstname = postgres_three_tasks
port = 5432
database = postgres
user = postgres
password = secret
```
## files to check  for each tasks
### task1: "App\Http\Controllers\TaskController->decryptMessage()"
### task2: "App\Http\Controllers\TaskController->encryptMessage()"
### task3: "App\Http\Controllers\TaskController->lcdDisplay"
### task4: "App\Http\Controllers\TaskController->lotteryWinners"
### task5: "App\Http\Controllers\TaskController->incomeStatistic"
