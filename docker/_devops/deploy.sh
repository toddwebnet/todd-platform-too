#!/bin/bash

if [  -z "$2" ]; then
  echo command requires 2 paramaters \<dev/prod\> \<local/container\>
  exit;
fi
SOURCE="`dirname "$0"`"
#
# if [ "$1" = "dev" ]; then
#   if [ "$2" = "local" ];then
#     $SOURCE/scripts/config_symlinks.sh;
#   # else
#   #
#   fi
# fi


# if [ "$2" = "local" ];then
#   echo doing npm things
#   cd $SOURCE/../../login-app && nvm use && npm install
# fi

if [ "$2" = "container" ];then
  $SOURCE/scripts/build_databases.sh

  echo doing composer things
  cd /var/www/account-api && composer install && php artisan migrate --seed
  cd /var/www/session-api && composer install
fi

echo "done";
