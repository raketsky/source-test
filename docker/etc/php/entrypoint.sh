#!/bin/sh
echo ' START PHP POST INSTALL SCRIPTS'

composer install

if [ ! -z "$APP_ENV" ] ; then
    composer dump-env prod
else
    composer dump-env dev
fi

# wait until MySQL is really available
maxcounter=45

counter=1

while ! mysql --protocol TCP -h"$MYSQL_HOST" -p"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "show databases;" > /dev/null 2>&1; do
    sleep 1
    counter=`expr $counter + 1`
    if [ $counter -gt $maxcounter ]; then
        >&2 echo "We have been waiting for for MySQL service too long already; failing."
        exit 1
    fi;
    echo "Waiting for MySQL service..."
done

echo "Running migrations..."
bin/console doctrine:migrations:migrate

echo ' END PHP POST INSTALL SCRIPTS'

docker-php-entrypoint $@