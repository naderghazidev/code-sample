FROM php:8.1.10-alpine3.16

LABEL maintainer="naderghazidev@gmail.com"

WORKDIR "/var/www/app/"

# install bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# set environment timezone to UTC
RUN echo "UTC" > /etc/timezone

# add composer package manager to environment
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# installing some reqiuired packages in alpine
RUN apk add --no-cache git curl sqlite libzip-dev supervisor

# install laravel required extensions
RUN	docker-php-ext-install bcmath pdo_mysql zip;

# supervisor configurations
RUN mkdir -p /etc/supervisor.d/
COPY .docker/supervisord.ini /etc/supervisor.d/supervisord.ini

# copy an entrypoint file
COPY .docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
