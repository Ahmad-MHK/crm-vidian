# Getting started

## First install Laravel

install composer 
of u have it installed u dont need to install

    https://getcomposer.org/

install Nodejs
of u have it installed u Dont need to innstall

    https://nodejs.org/en

of it does not work Read this

    https://laravel.com/docs/10.x/installation

## Installation

Clone the repository/Folder

    git clone https://github.com/Ahmad-MHK/crm-vidian.git


switch to the folder

    cd crm-vidian

install Composer and npm

    composer install
    npm install

Copy the example env file and make the required configuration changes in the .env file

    copy .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations 

    php artisan migrate


Run the database seeder

    php artisan db:seed

Build your dependencies & start the local development server

    npm run build
    npm run dev

Default login Email :

    Admin@admin.com
    
    developer@admin.com
    
    Superadmin@admin.com
    
    moderator@admin.com

Default login password:

    password

All Commands

    git clone https://github.com/Ahmad-MHK/crm-vidian.git
    cd crm-vidian.git
    composer install
    npm install
    php artisan migrate
    npm run build
    npm run dev
    php artisan db:seed

## of u get error with database

refresh database

    php artisan migrate:refresh

than u need to reintall your Seeder to login

    php artisan db:seed

