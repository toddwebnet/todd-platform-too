
ARG NGINX_DOCKERFILE_SOURCE=I_WILL_FAIL
FROM ${NGINX_DOCKERFILE_SOURCE}

LABEL maintainer="James Todd"

COPY nginx.conf /etc/nginx/

RUN apk update \
    && apk add --no-cache openssl \
    && apk add --no-cache bash \
    && apk add --no-cache curl \
    && adduser -D -H -u 1000 -s /bin/bash www-data

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod 777 /usr/local/bin/docker-entrypoint.sh
RUN ln -sf usr/local/bin/docker-entrypoint.sh /entrypoint.sh # backwards compat

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]
