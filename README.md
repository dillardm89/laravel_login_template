# laravel_login_template
Laravel Login App Template

![](https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExd3JsaWY1OTE0c2gzNW81MmEwanA3MGhqa29hcjVidHU4MzhoMTVibiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/no71fU7M1KMrQXvghZ/giphy.gif)


## Installation & Deploy

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
