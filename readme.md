#Trusted Marketplace
A [WeGovNow](http://wegovnow.eu) basic component.

##Requirements
- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension


##Install
Clone this repo and install dependencies via composer

```
$ composer update
```

##Configuration

####Configuration variables
Rename the .env.example to .env and edit the application’s configuration variables. You should also check if the APP_KEY variable has been generated. If not, you should run the command below, or your user sessions and other encrypted data will not be secure.

```
$ php artisan key:generate
```

####Public directory
After installing Laravel, you should configure your web server's document/web root to be the *public* directory. The index.php in this directory serves as the front controller for all HTTP requests entering your application.

####Permissions
Also, you may need to configure some permissions. Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run.

####Database
After creating the project's database, you should run the commands below to create the database tables and generate some dummy data.

```
$ php artisan migrate
$ php artisan db:seed
```
