<h1>Trusted Marketplace</h1>
A <a href="http://wegovnow.eu" target="_blank">WeGovNow</a> basic component.

<h2>Requirements</h2>
<ul>
    <li>PHP >= 5.6.4</li>
    <li>OpenSSL PHP Extension</li>
    <li>PDO PHP Extension</li>
    <li>Mbstring PHP Extension</li>
    <li>Tokenizer PHP Extension</li>
    <li>XML PHP Extension</li>
</ul>

<h2>Install</h2>
Clone this repo and install dependencies via composer

```
$ composer update
```

<h2>Configuration</h2>

<h4>Configuration variables</h4>
Rename the .env.example to .env and edit the application’s configuration variables. You should also check if the APP_KEY variable has been generated. If not, you should run the command below, or your user sessions and other encrypted data will not be secure.

```
$ php artisan key:generate
```

<h4>Public directory</h4>
After installing Laravel, you should configure your web server's document/web root to be the public directory. The index.php in this directory serves as the front controller for all HTTP requests entering your application.

<h4>Permissions</h4>
Also, you may need to configure some permissions. Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run.

<h4>Database</h4>
After creating the project's database, you should run the command below to create the database tables and then import the demo database file tmp.sql to have some testing data.

```
$ php artisan migrate
```

