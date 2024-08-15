# laravel_login_template
Laravel Login App Template

![](https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExd3JsaWY1OTE0c2gzNW81MmEwanA3MGhqa29hcjVidHU4MzhoMTVibiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/no71fU7M1KMrQXvghZ/giphy.gif)

## Env Required Configs

### Required variables prior to deploy.

-   DB_CONNECTION=(your_db -> ex: mysql)
-   DB_HOST=(your_host -> ex: 127.0.0.1)
-   DB_PORT=(your_port -> ex: 3306)
-   DB_DATABASE=(your_dbname)
-   DB_USERNAME=(your_username)
-   DB_PASSWORD=(your_password)

-   MAIL_MAILER=smtp (or alternative)
-   MAIL_HOST=(your_email_host)
-   MAIL_PORT=(your_email_port -> ex: 587)
-   MAIL_USERNAME=(your_username)
-   MAIL_PASSWORD=(your_password)
-   MAIL_ENCRYPTION=(your_encryption -> ex: tls)
-   MAIL_FROM_ADDRESS=(your_email)

## Deploy Locally

### Running this app locally requires multiple (3) terminals.

1.  Vite
2.  Artisan (Serve)
3.  Artisan (Queue Work)

```bash
# Terminal 1
npm install
npm run dev

# Terminal 2
php composer install
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve

# Terminal 3
php artisan queue:work

```
