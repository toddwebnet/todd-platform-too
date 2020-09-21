#!/bin/bash

if [ "$LINUX_HOST" = "true" ]
then
    echo "$(netstat -nr | grep '^0\.0\.0\.0' | awk '{print $2}') host.docker.internal" >> /etc/hosts && echo "Host File Entry Added for Linux!!!!!" || :
fi

exec "$@"
