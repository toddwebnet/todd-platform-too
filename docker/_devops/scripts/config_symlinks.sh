#!/bin/bash
echo generating config symlinks
SOURCE="`dirname "$0"`"
ln -s dev/account-api.env $SOURCE/../configs/account-api.env
ln -s dev/session-api.env $SOURCE/../configs/session-api.env
ln -s dev/login-app.config.js $SOURCE/../configs/login-app.config.js
ln -s dev/admin-app.config.js $SOURCE/../configs/admin-app.config.js

ln -s ../../docker/_devops/configs/login-app.config.js $SOURCE/../../../login-app/src/config.js
ln -s ../../docker/_devops/configs/admin-app.config.js $SOURCE/../../../admin-app/src/config.js
