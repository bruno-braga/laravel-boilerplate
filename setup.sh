#!/bin/bash

# Author: Bruno Braga <bruunoo@protonmail.com>

# Description
# Either bootstraps the application by creating
# a database and running its migration and then
# seeding the data or rollsback all the migrations
# and then seed the data again

# Usage
# setup bootstrap or setup

set -e

DATABASE=$(cat .env.example | sed -n -e 's/DB_DATABASE=//p')


function create_env() {
    cp .env.example .env
}

function generate_env_key_jwt() {
    ./vendor/bin/sail php artisan key:generate
    ./vendor/bin/sail php artisan jwt:secret
    ./vendor/bin/sail php artisan jwt:generate
}

function rollback() {
    ./vendor/bin/sail php artisan migrate:rollback
}

function migrate_seed() {
    ./vendor/bin/sail php artisan migrate:rollback
    ./vendor/bin/sail php artisan migrate
    ./vendor/bin/sail artisan module:seed
}

function add_sail() {
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
}

case $1 in

    bootstrap)
        echo "bootstraping..."

        if [ -f "/vendor/bin/sail" ]; then
            echo "sail is already installed. proceeding..."
        else
            add_sail
        fi

        echo "creating .env file"
        create_env

        echo "starting up docker"
        ./vendor/bin/sail up -d

        echo "running the migrate and seeders..."
        migrate_seed

        echo "generating app and jwt keys..."
        generate_env_key_jwt
    ;;

    *)
        echo "rolling back all database changes..."
        rollback

        echo "migrating and seeding the databae..."
        migrate_seed
    ;;
esac
