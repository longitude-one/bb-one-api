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

## 4. Complete the Validation Entity

### 4.1. Add the unique constraints

```php
Add one unique constraint foreach unique property. 
Don't forget that the above line should be added to the class not the property.

```php
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['username'], message: 'There is already an user with this username')]
```

### 4.2. Add the validation constraints

Add the validation constraints for each property.

```php
use Symfony\Component\Validator\Constraints as Assert;

#[Assert\NotBlank]
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
