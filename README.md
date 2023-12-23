# Laravel Requirments and installation

## Requirements

### For Ubuntu:
- **Database Version**: MySQL Ver 8.0.35
- **Server version**: Apache/2.4.41
- **PHP version**: PHP 8.1.26
- **Composer Version**: Composer version 2.6.3

### For Windows:
- **XAMPP version**: 8.2.12
- **Composer Version**: Composer version 2.6.3

**Note**: When installing Composer, use XAMPP's command-line PHP. Also, ensure that XAMPP's PHP is added to your system variables path (usually `C:\xampp\php`).

## Installation and Running the API Guide

### For Ubuntu:
Start the Apache server using the command:
```bash
sudo service apache2 start
```  
  
Start the MySQL server using the command:
```bash
sudo service mysql start
```  
### For Windows:
For windows
Open Xampp and click start on Apache and MySQL.

## After running the Apache and MySQL servers:

go to the API directory and change the `.env.example` file’s name to `.env`, change the database environment variable credentials to match your database. Default is:
```
DB_USERNAME=root
DB_PASSWORD=
```

Then open the terminal or CMD inside the directory and insert the command 

```bash
composer install
```

This will install all the necessary packages and dependencies.
After the installation is complete, run the command

``` bash
php artisan migrate
```

This will migrate the database to you local database
You’ll get a prompt asking if you would like to create the `loginregister` database since it doesn’t exist on your local database, type yes to create it. You may also create it manually using your preferred database manager.

(optional) After the database is migrated run the command 
```bash
php artisan db:seed
```

This will seed the database with two users, and 6 posts.
Email: usera@example.com , Password: 123456A_ And Email: userb@example.com , Password: 123456A_ 
Each of which has 3 posts

Finally run the command
```bash
php artisan serve
```
to start the api server.

you may now begin to test the routes.

**Please refer to the documentation for details on the routes**