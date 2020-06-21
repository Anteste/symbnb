# Symbnb

SymBNB can be used:
 - to travelers, in order to find a good to find accommodation during their stay.
 - property owners, in order to rent their apartment or house to travelers.
 
Programming languages ​​used:
  - php
  - javascript
  - twig
  
Framework used: Symfony 5.1.0
Database: MySQL

INSTALLATION:
- Clone the project
```sh
$ git clone https://github.com/Anteste/symbnb.git
```

- Install dependencies
```sh
$ composer install
```

- Configure your database in the .env file
```sh
DATABASE_URL=mysql://symfony:symfony@127.0.0.1:3308/symfony:symfony
```

- Start migrations
```sh
$ php bin/console doctrine:migrations:migrate
```

- Launch the fixtures
```sh
$ php bin/console doctrine:fixtures:load
```

- Start the server 
```sh
$ symfony serve
```
