Development Practicle Test 
## Install
Clone project folder
<br>
Go to the folder application using cd command on your cmd or terminal
<br>
Run composer install on your cmd or terminal
<br>
Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
<br>
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
<br>
Run php artisan key:generate
<br>
Run php artisan migrate
<br>
Run php artisan serve
<br>
Go to http://localhost:8000/ 
<br>
Username: **admin@bcity.com**
<br>
password: **password**


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
