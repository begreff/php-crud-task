
### First things first

The database script is in `config/db.sql`.

Run the server with `php -S localhost:8080`

Run the tests with `phpunit  -c tests/phpunit.xml tests`

Everything should work as intended.

### Technologies used

I used `PHP 7.4`, `MySQL`, `PHPUnit`, `JavaScript`, `JQuery` and `Bootstrap`.

I implemented the project without using a framework - being new to PHP, I wanted to learn it the hard way.

### Decisions made

I created a Database class which retrieves database configuration details from `config.php`.

I created a Repository class for each of the database entities. 

I also added Controller classes, which retrieve the data needed for the views via the repositories and then load the views. They do not deal with the changes the user makes, as I haven't yet implemented a router.

The changes are dealt with by the code in `src/actions`.

Students are created/deleted by sending AJAX calls to a REST API.

### Reflection

The program could benefit from Router and Request classes, as well as a Query class for abstracting database calls shared between the repositories.

The solution is not up to my standards - I prefer code that is clean and easy to understand, and parts of this are not.

I did, however, learn a lot. 

Not just PHP, but also PSR standards, composer, config files and such.

Working without a framework made me really appreciate just how much abstraction they offer.
