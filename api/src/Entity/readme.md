# Creating a new entity step by step

## 1. Create a new class with the maker bundle

```shell
docker compose exec php bin/console make:entity --api-resource
```

## 2. Complete API Platform configuration

## 3. Complete the Doctrine Element

Table name should respect the following rules:
* the table name should be prefixed with the project name: `bbone_` ;
* the table name should be plural (ex: `characters`) ;
* the table name should be in snake case ;

```php
#[ORM\Table(name: 'bbone_characters')]
```

## 4. Add some fixtures

```shell
docker compose exec php bin/console make:fixtures
```

Update the created factory to configure data.
Add a line in the AppFixtures class to load and call the new factory.
Then load data

```shell
docker compose exec php bin/console doctrine:fixtures:load --no-interaction
```
