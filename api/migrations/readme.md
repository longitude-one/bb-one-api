# Database migrations

## Create a new migration

Migration files are generated with the following command:

```bash
docker compose exec php bin/console doctrine:migrations:diff
```

This command will generate a new migration file in `api/migrations` directory.
Update the created file to reflect the changes you want to apply to the database.

## Execute migrations

To execute migrations, run the following command:

```bash
docker compose exec php bin/console doctrine:migrations:migrate --no-interaction
```

## Rollback migrations

To rollback last migration, run the following command:
    
```bash
docker compose exec php bin/console doctrine:migrations:migrate prev --no-interaction
```
