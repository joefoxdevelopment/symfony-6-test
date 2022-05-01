# symfony-6-test
The purpose of this is to figure out how difficult Symfony is to do simple
things with that //should// be trivial when setting up any new application in
a framework.

The main points I was curious about:
- MVC + Dependency Injection
    - Default container injection
    - Factories
    - Type hinting on service interfaces
- Routing
- Request handling
- Code quality checks

To try satiate my curiosity, this is set up to be as basic as possible.
- There are 2 endpoints, each with an invokable Controller.
    - GET /users returns a list of all known users in the Dal
    - GET /users-search accepts a name query param, to filter the results of
    all users returned by the Dal.
- The user dal returns a hard coded list of user entities, a substitute for a
dal which queries an external resource (api/db).
- There's a user search class to to demonstrate catching and fetching.

## How to get it up and running
Using the local php webserver
```bash
cd /path/to/repo
./composer.phar install
php -S localhost:8000 public/index.php
```

## Running the code quality checks
### PHPUnit
```bash
bin/phpunit
```

### PHPStan
```bash
vendor/bin/phpstan
```

### PHPMD
```bash
bin/phpmd
```


## Things I do quite like
- Just existing is the bare minimum for a class to get registered with the
service container.
- First attempt at retroactively fixing PHPStan and PHPMD warnings. By default,
I've used the strictest or as many rules as each can apply. PHPStan especially
being used to allow for generics in developer space is really rather nice,
especially with how the user dal is.
    - Minor caveat is how awkward PHPMD is to configure, as it doesn't take a
    config file like PHPUnit or PHPStan, I've created a wrapper script in
    `bin/phpmd` to store the parameters I've been using.

## Things I'm not quite convinced about yet
- PSR interoperability (Things don't appear to obviously use the PSR interfaces)
    - After a bit more digging, I'm even less convinced by the Symfony approach.
    When writing my unit tests for the GET /users-search controller, I was
    unable to set up mocks for the query params as the class used to hold these
    is `final`. `Psr\Http\Message\ServerRequestInterface::getQueryParams()`
    returns an array, which is simple enough to mock.
