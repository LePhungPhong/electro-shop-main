# Cài PHP deps

composer install

# Tạo APP_KEY

php artisan key:generate

# Migrates

php artisan migrate

# Seed (nếu có seeder)

php artisan db:seed

# Link storage

php artisan storage:link

# Chạy backend

php artisan serve --host=127.0.0.1 --port=8000

# Cài frontend deps

npm install

# Chạy frontend dev (Tailwind/Vite)

npm run dev

php artisan migrate:fresh
php artisan db:seed
php artisan storage:link
