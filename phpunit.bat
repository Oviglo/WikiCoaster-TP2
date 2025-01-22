call symfony console doctrine:database:drop --force --env=test -q
call symfony console doctrine:database:create --env=test -q
call symfony console doctrine:schema:update --force --env=test -q
call symfony console doctrine:fixtures:load --env=test -q
call C:\tools\php83\php.exe bin/phpunit