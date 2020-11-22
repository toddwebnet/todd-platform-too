#!/bin/bash
echo building databases
SOURCE="`dirname "$0"`"

mysql -uroot -ppassword -hmysql <$SOURCE/../../../account-api/_devops/create.sql
