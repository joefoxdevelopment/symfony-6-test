# symfony-6-test
The purpose of this is to figure out how difficult Symfony is to do simple
things with that

The main points I was curious about:
- MVC + Dependency Injection
    - Default container injection
    - Factories
    - Type hinting on service interfaces
- Routing
- Request handling

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

## Things I do quite like
- Just existing is the bare minimum for a class to get registered with the
service container.

## Things I'm not quite convinced about yet
- PSR interoperability (Things don't appear to obviously use the PSR interfaces)
