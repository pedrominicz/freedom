# Freedom

A book sharing website made with Laravel. A static version of the website with some classic Japanese novels can be found [here](https://pedrominicz.github.io/freedom/index.html).

## Running the website

Clone this repository and `cd` into it.

```
$ git clone https://github.com/pedrominicz/freedom
$ cd freedom
```

Install `composer` dependencies.

```
$ composer install
```

Install `npm` dependencies.

```
$ npm install
```

Set up a database to be used by the site. In this example, I will use MariaDB, but feel free to use any other database server.

```
$ systemctl start mariadb.service
$ mysql -u root -p
Enter password:
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 10
Server version: 10.3.15-MariaDB Source distribution

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> CREATE DATABASE freedom;
Query OK, 1 row affected (0.000 sec)

MariaDB [(none)]> Bye
```

Create your `.env` file.

```
$ cp .env.example .env
```

Edit database information in the `.env` file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=freedom
DB_USERNAME=root
DB_PASSWORD=root
```

Generate app encryption key.

```
$ php artisan key:generate
```

Migrate the database.

```
$ php artisan migrate
```

Link storage.

```
$ php artisan storage:link
```

And, finally, start the website.

```
php artisan serve
```

You can now create an account on the website by visiting `localhost:8000/register`. After creating the account you can make it an administrator.

```
$ mysql -u root -p
Enter password:
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 15
Server version: 10.3.15-MariaDB Source distribution

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> USE freedom;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
MariaDB [freedom]> UPDATE users SET is_admin=1 WHERE id=1;
Query OK, 1 row affected (0.147 sec)
Rows matched: 1  Changed: 1  Warnings: 0

MariaDB [freedom]> Bye
```

You will now be able to add books to the website by visiting `localhost:8000/a`.
