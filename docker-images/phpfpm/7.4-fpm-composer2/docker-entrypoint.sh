#!/bin/sh
set -e

sudo chown -R app:app /var/www

if ! host -t A "host.docker.internal" > /dev/null
then
    echo "Adding host.docker.internal to /etc/hosts..."
    #TODO: Issues on Linux, needs debugger
    #ip -4 route list match 0/0 | awk '{print $3 " host.docker.internal"}' >> /etc/hosts
else
    echo "host.docker.internal already defined,skipping."
fi

#CHECK VERSION COMPOSER
if [ "${COMPOSER_VERSION}" ]; then
  sudo composer self-update ${COMPOSER_VERSION}
fi

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

exec "$@"