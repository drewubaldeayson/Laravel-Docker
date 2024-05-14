#!/bin/sh

set -e

# for package dependencies via composer
if [ -d "vendor" ]
then
    echo "Directory vendor already exists."
else
    echo "Run composer install..."
    sleep 1s
    composer install
fi