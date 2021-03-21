#!/bin/sh

bin/console doctrine:database:drop --force
bin/console doctrine:database:create --if-not-exists
bin/console doctrine:schema:create
bin/console doctrine:database:import database_data.sql
