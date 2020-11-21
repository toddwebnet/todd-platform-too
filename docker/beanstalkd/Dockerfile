FROM alpine
LABEL maintainer="James Todd <toddwebnet@gmail.com>"

RUN apk add --no-cache beanstalkd

EXPOSE 11300
ENTRYPOINT ["/usr/bin/beanstalkd"]
