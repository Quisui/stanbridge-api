<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Lunch App
### Clone repo
```bash
git clone https://github.com/Quisui/stanbridge-api.git
```
### Install Dependencies
```bash
composer install
```
### Change your env files, I didn't dockerize the app for practical purposes, check my other repos to [check]() how i dockerized those
Create a database in mysql named standbdrige or any name you want
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=standbdrige
DB_USERNAME=root
DB_PASSWORD=password
### Clear cache
```bash
php artisan optimize:clear

```
# Run [migrations]()
```bash
php artisan migrate:fresh --seed
```

# Relations 
Instructor <br />
- Has many courses <br />
- Has many through student and courses <br />
Courses <br />
- Belongs to instructor <br />
- Belongs to many students <br />
Student <br />
- Belongs to many courses <br />
- Has many instructors through Instructor and Course <br />

