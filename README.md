### Email validation via RESTful API

Developed in Environment: Laravel 5.6.16, PHP 7.1.12, Node.js 8.9.4, Ubuntu 14.04.5 LTS

### Get Started

```bash
# Note: This guide is based on Linux development environments.
# Apache or other server configuration & virtual environments setup
# are not examined in this README version.

# Find more @ Laravel official documentation
# https://laravel.com/docs/5.6

##

# Open your terminal & follow the steps below

### Step 1 -> SETUP

# Clone project to your environment
git clone --depth https://github.com/applicationsdev/laravel-rest-email-validation.git

cd laravel-rest-email-validation/

# Install dependencies, defined in composer.json & package.json
composer install
npm install

# To combine this with Front End tasks, consider these npm commands
npm rebuild node-sass
npm run dev

# Your MySQL server must be running
# Login to your MySQL using cli or a visual tool like PHPmyAdmin
# & create a new database to use it with this Laravel app
# SQL syntax example: CREATE DATABASE my_db_name;

# Laravel .env setup

# rename file ".env.example" to ".env"
mv .env.example .env

# Generate application key
php artisan key:generate

# Now, edit the .env file with your favorite text editor
# Add the database name (you created above) + your DB user name & password
# at the fields DB_DATABASE, DB_USERNAME, DB_PASSWORD
# This way, Laravel will connect to your local MySQL server

# Run migrations
php artisan migrate

##

### Step 2 -> TESTING

# To test the Email Validation API with the provided PHPunit tests
vendor/bin/phpunit

# To test the Email Validation API live,
# you can generate some testing data & store to database
php artisan db:seed

# To serve the app (on a development environment basis), use the command
# php artisan serve --host YOUR_LOCALHOST_IP --port YOUR_LOCALHOST_PORT
# Example:
php artisan serve --host 127.0.0.1 --port 8080

# To test the Email Validation API using cURL run the command
# Syntax example:
curl -X GET -H "Accept:application/json" -i -s http//YOUR_LOCALHOST_IP/api/validate/email/EMAIL_ACCOUNT
#
# as YOUR_LOCALHOST_IP use your localhost -> example: 127.0.0.1
# as EMAIL_ACCOUNT, use any email stored in the database table: validated_emails
# To find these email accounts, login your MySQL via cli or visual tool (like PHPmyAdmin)
# SQL syntax example: USE my_db_name; SELECT * FROM validated_emails;

# To test the Email Validation API using some great REST visual tools, go to these urls
# https://www.getpostman.com/
# https://addons.mozilla.org/en-US/firefox/addon/rested/

```

Fork, improve, share

@applicationsdev

GPLv3
