how to download 

git

git clone https://github.com/Ahmad-MHK/crm-vidian.git

cd crm-vidian.git

composer install
npm install

cp .env.example .env

php artisan migrate

npm run build
npm run dev
