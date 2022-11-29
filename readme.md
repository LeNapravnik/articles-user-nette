
Articles-user-nette
===================================

App for viewing list of articles and user administration. 

Articles can be visible for all users or only for logged users - this can be set on the page with articles. Articles can be ordered and filtered by title, date of insertion, rating. 

Logged user can rate articles (+1, -1), change his password, log out.

I made this app as a small testing project, to show example of my coding skills.


Installation
------------

Set the database access data in the `config/local.neon` file:

```neon
database:
	dsn: 'mysql:host=127.0.0.1;dbname=articles_db'
	user: ***
	password: ***
```

And create tables in the database by importing the `db/structures/db.sql` file

For adding some starting data (articles, users) import the `db/data/dummy-data.sql` file

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

```shell
php -S localhost:8000 -t www
```

Then visit `http://localhost:8000` in your browser to see the welcome page.
