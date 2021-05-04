## Laravel v6.20.26
- LaravelInstaller v4.2.5
- Composer v2.0.13
- Node v14.16.1
- npm v.7.11.2
- laravel/ui v1.2
- php v8.0.3 / requires PHP 7.2 or greater

--[webpackmix]--[assets]--[sass]

- run git clone https://github.com/alexnet-dev/blue.git
- open in code editor 
- open the terminal (<kbd>Ctrl</kbd> + <kbd>`</kbd>) 
- run composer install 
- run npm install 
- run npm run dev
- run composer dump-autoload
- create .env file
- setup .env file as follows:
- 
    APP_NAME=Blue
    APP_ENV=local
    APP_KEY=base64:(run php artisan key:generate)
    APP_DEBUG=true
    APP_URL=http://localhost

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=(ie myblog)
    DB_USERNAME=root
    DB_PASSWORD=

    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=(smtp.mailtrap.io)
    MAIL_PASSWORD=(smtp.mailtrap.io)
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=welcome@blue.com
    MAIL_FROM_NAME="${APP_NAME}"

- run php artisan key:generate
- run php artisan migrate
- run php artisan db:seed
- run php artisan storage:link to be able to see article's images in blade
- run php artisan serve
