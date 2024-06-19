# Personalized Video Campaign Manager

Intructions to run the app and how it works.
 
# Requirements:
PHP  8.3
MySQL 8.0

1. git clone https://github.com/ritshidze/listing-things.git

   - composer install
   - composer dump-autoload
   - npm install
   - npm run dev

2. Create a database table 
3. Setup mailtrap details

    - MAIL_MAILER=smtp
    - MAIL_HOST=smtp.mailtrap.io
    - MAIL_PORT=2525
    - MAIL_USERNAME=********
    - MAIL_PASSWORD=********
    - MAIL_ENCRYPTION=tls
    - MAIL_FROM_ADDRESS=****@gmail.com

4. Run Migration: php artisan migrate 
5. Run Seeder: php artisan db:seed
6. NB >> Please copy "images" folder to "storage/app/public/"
7. Run the php artisan storage:link
8. Run the app: php artisan serve

  - go to http://127.0.0.1:8000
  - You should see llanding page with a search tool
  - You can register user and also login
  - Login Detail: johndoe@example.com and password: mypassword
  - Once you logedin navigate to http://127.0.0.1:8000/admin
  - Once you are in the admin you can manage listings(livewire stuff)

# -------------------
