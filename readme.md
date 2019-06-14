# Freedom

A book sharing website made with Laravel. A static version of the website with some classic Japanese novels can be found [here](https://pedrominicz.github.io/freedom/index.html).

The site uses four tables: [`books`](database/migrations/2019_06_01_001639_create_books_table.php), [`users`](database/migrations/2019_06_01_192225_create_users_table.php), [`favorites`](database/migrations/2019_06_01_231928_create_favorites_table.php), and [`comments`](database/migrations/2019_06_14_000006_create_comments_table.php). Each book has a `file` column which points to the book file stored in `storage/app/public/` and an optional cover image. The book file could be an EPUB, a PDF, or anything, really. `users` is the default Laravel users table with an `is_admin` column added. Each favorite just holds a `user_id` and a `book_id`. Comments are similar but have a `body` column.

The site has four controllers: [`BookController`](app/Http/Controllers/BookController.php), [`CommentController`](app/Http/Controllers/CommentController.php), [`FavoriteController`](app/Http/Controllers/FavoriteController.php), and [`HomeController`](app/Http/Controllers/HomeController.php). Of these `BookController` is the biggest, but still pretty straight forward.

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
$ mysql -u root -p freedom
Enter password:
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 23
Server version: 10.3.15-MariaDB Source distribution

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [freedom]> UPDATE users SET is_admin=1 WHERE id=1;
Query OK, 0 rows affected (0.000 sec)
Rows matched: 1  Changed: 0  Warnings: 0

MariaDB [freedom]> Bye
```

You will now be able to add books to the website by visiting `localhost:8000/a`.

If you want to delete the site just `rm -rf freedom` and don't forget to drop the database.

```
$ mysql -u root -p
Enter password: 
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 97
Server version: 10.3.15-MariaDB Source distribution

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> DROP DATABASE freedom;
Query OK, 6 rows affected (1.413 sec)

MariaDB [(none)]> Bye
```
