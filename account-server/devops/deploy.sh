#!/bin/bash

[ -e ../../docker/nginx/sites/account.conf ] && rm ../../docker/nginx/sites/account.conf
cp ./account.nginx.conf ../../docker/nginx/sites/account.conf

# mysql -uroot -ppassword -hmysql < ./create.sql
