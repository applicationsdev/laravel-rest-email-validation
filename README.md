```bash
# Email validation via RESTful API
# Developed in Environment: Laravel 5.6.16, PHP 7.1.12, Node.js 8.9.4, Ubuntu 14.04.5 LTS


# Get Started

# Note: This guide is based on Linux development environments.
# Apache or other server configuration & virtual environments setup
# are not examined in this README version.

# Run the following commands in your terminal

# Clone project to your environment
git clone --depth https://github.com/applicationsdev/laravel-rest-email-validation.git

cd laravel-rest-email-validation/

# Install dependencies, defined in composer.json & package.json
composer install
npm install

# To combine this repository with Front End tasks, consider these npm commands
npm rebuild node-sass
npm run dev

# Login to your MySQL using cli or a visual tool like PHPmyAdmin
# & create a new database to use it with this Laravel app
# SQL syntax example: CREATE DATABASE my_db_name;

# Laravel setup
mv .env.example .env

# Edit .env file with your favorite text editor
# & add at least your database name, user name & password

# Run migrations
php artisan migrate

# Generate test data
php artisan db:seed

# To serve the app for development environment use the command
# php artisan serve --host YOUR_IP --port YOUR_PORT
# Example:
php artisan serve --host 127.0.0.1 --port 8080

# To test the Email Validation API with PHPunit run the command
vendor/bin/phpunit

# To test the Email Validation API using cURL run the command
# Example:
curl -X GET -H "Accept:application/json" -i -s http//LOCALHOST/api/validate/email/EMAIL_ACCOUNT
# as LOCALHOST use your localhost -> example: 127.0.0.1
# as EMAIL_ACCOUNT, use any email stored in the database table: validated_emails

# To test the Email Validation API using visual tools, check these
# https://www.getpostman.com/
# https://addons.mozilla.org/en-US/firefox/addon/rested/


# Fork this project, improve it & make your own version of data validation API
# @applicationsdev
# GPLv3

```
