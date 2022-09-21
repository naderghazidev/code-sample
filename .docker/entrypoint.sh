#!/usr/bin/env bash

composer install

supervisord -c /etc/supervisor.d/supervisord.ini
