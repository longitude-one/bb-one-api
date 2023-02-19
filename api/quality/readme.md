
How to run PhpStan:
```shell
docker run --init -it --rm -v "$(pwd):/project" -v "$(pwd)/api/var/quality/tmp-phpqa:/tmp" -w /project longitudeone/phpqa:latest phpstan analyse --configuration=api/quality/php-stan/php-stan.neon --level=9
```

How to run PHP CS Fixer:
```shell
docker run --init -it --rm -v "$(pwd):/project" -v "$(pwd)/api/var/quality/tmp-phpcs:/tmp" -w /project jakzal/phpqa:php8.1-alpine php-cs-fixer fix --config=api/quality/php-cs-fixer/.php-cs-fixer.php --allow-risky=yes
```
