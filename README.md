# Namkhast Project
## About
this project just only for final university project and you should not use this for your business.

## requirements
- PHP >= 7.3.0
- Composer >= 2.1
- Nodejs >= 14
- Npm >= 6.14
- Mysql >= 8

## how to run it
1. clone the project 
```
    git clone https://github.com/foroughi1380/namkhast.git
```
2. install php packages
```
    composer install
```
3. install javascript dependencies
```
    npm install
```
4. now your shold create .env file
```
    cp .env.example .env
```
>or you can use this example (replase your database connection )
```
APP_NAME=NamKhast
APP_ENV=local
APP_KEY=base64:q5H2ZAeX3c+UHaJEw1RUmuLsj+1ttRythGLJRl+1VZY=
APP_DEBUG=true
APP_URL=http://localhost
APP_HOSTNAME=localhost

IdPay_Key=
IdPay_SandBox=1

MIX_RECAPTCHA3_SITE=
MIX_RECAPTCHA3_SECRET=

SMS_MELIPAYAMAK_USERNAME=
SMS_MELIPAYAMAK_PASSWORD=
SMS_MELIPAYAMAK_CONFIRM_CODE_PATTERN_ID=

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=
AWS_ENDPOINT=
AWS_PUBLIC_DOWNLOAD_PREFIX=
AWS_USE_PATH_STYLE_ENDPOINT=true

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
>to create key run `php artisan key:generate`
5. create databases
```
    php artisan migrage
```
6. run all seeder
```
     php artisan db:seed
```

7. start the project whit
```
    php artisan serve
```
- or in your apache or another software you know.
> you can access the admin control panel in https://[yourhost or localhost url]/ac


> defalt admin user is 
>
> usernmae : superuser@namkhast.ir
> 
> password : 12345678


- Finally, if you have problems in the Routes or somethings, use the following command:
```
    php artisan optimize:clear
```

### project demo site
You can see [Namkhast.ir](https://namkhast.ir)

>Owners : Mohamad Foroughi , Seyed Mohammad Khalili
