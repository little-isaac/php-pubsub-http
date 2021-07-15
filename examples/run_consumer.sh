#!/bin/bash

cd /opt/php-pubsub/
composer require milind/php-pubsub-google-cloud
composer dump-autoload
cd /opt/php-pubsub/examples

php HTTPConsumerExample.php
