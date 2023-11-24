# Getting started

## Installation

Clone the repository/Folder

    git clone https://github.com/Ahmad-MHK/crm-vidian.gi


switch to the folder

    cd crm-vidian.git

install Composer and npm

    composer install
    npm install

Run the database migrations 

    php artisan migrate

Build your dependencies & start the local development server

    npm run build
    npm run dev

Run the database seeder

php artisan db:seed

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

# of u get error with database

refresh database

    php artisan migrate:refresh

than u need to reintall your Seeder to login

    php artisan db:seed

