## Laravel v6.20.26
--[LaravelInstaller v4.2.5]()
--[Composer v2.0.13]()
--[Node v14.16.1]()
--[npm v.7.11.2]()
--[laravel/ui v1.2]()
--[php v8.0.3 / requires PHP 7.2 or greater]()

--[webpackmix]--[assets]--[sass]

<ul>
<li>run git clone https://github.com/alexnet-dev/blue.git</li>
<li>open in code editor</li> 
<li>open the terminal (<kbd>Ctrl</kbd> + <kbd>`</kbd>)</li> 
<li>run composer install</li> 
<li>run npm install</li> 
<li>run npm run dev</li>
<li>run composer dump-autoload</li>
<li>create .env file</li>
<li>setup .env file as follows:</li>

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

<li>run php artisan key:generate</li>
<li>run php artisan migrate</li>
<li>run php artisan db:seed</li>
<li>run php artisan storage:link to be able to see article's images in blade</li>
<li>run php artisan serve</li>
</ul>