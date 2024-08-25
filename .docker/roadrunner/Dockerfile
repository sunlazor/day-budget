FROM ghcr.io/roadrunner-server/roadrunner:2023.3 AS roadrunner
FROM php:8.3-cli

# sudo не помог
RUN apt update && apt install -y --no-install-recommends git unzip sudo

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
#RUN install-php-extensions bcmath gd intl memcached opcache pcntl rdkafka-5.0.2 soap
RUN install-php-extensions sockets zip
RUN install-php-extensions pdo_pgsql pgsql
RUN install-php-extensions xdebug

COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

# + Add User
ARG PUID=1000
ARG PGID=1000
ARG USER=dev

RUN set -xe; \
    groupadd -g ${PGID} dev && \
    useradd -l -u ${PUID} -g dev -m ${USER} -G sudo && \
    usermod ${USER} -s /bin/bash

RUN echo "${USER} ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers
USER ${USER}
# - Add User

#RUN rr --version