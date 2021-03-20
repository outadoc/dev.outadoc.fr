#!/bin/sh

bin/console doctrine:database:create --if-not-exists --no-debug
bin/console doctrine:schema:create --no-debug
bin/console doctrine:database:import database_data.sql --no-debug
