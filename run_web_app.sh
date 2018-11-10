#!/bin/bash

LARAVEL_PATH="src/Infrastructure/Framework/Laravel"

containers=$(docker ps | grep "algorath_test_web" | sed -r "s/( .*)//g")
if [[ "$containers" != "" ]]
then
	echo "Stopping algorath_test_web containers..."
	docker stop $containers
fi

docker/dev/composer install &&\
docker/dev/composer_framework install &&\
touch $LARAVEL_PATH/database/database.sqlite &&\
cat $LARAVEL_PATH/.env.example | sed "s/=mysql/=sqlite/g" > $LARAVEL_PATH/.env &&\
docker build -t algorath_test_web . &&\
docker run -v $(pwd):/app -p 8181:8181 algorath_test_web
