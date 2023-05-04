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
### Change your env files, I didn't dockerize the app for practical purposes, check my other repos to [check](https://github.com/Quisui/buckhill-challenge) how i dockerized those  <br />
Create a database in mysql named standbdrige or any name you want  <br />
DB_CONNECTION=mysql  <br />
DB_HOST=127.0.0.1  <br />
DB_PORT=3306  <br />
DB_DATABASE=standbdrige  <br />
DB_USERNAME=root  <br />
DB_PASSWORD=password  <br />
### Clear cache
```bash
php artisan optimize:clear

```
# Run [migrations](https://github.com/Quisui/stanbridge-api/tree/develop/database/migrations)
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

# Courses
So as the endpoints said we can return all courses from our database that has the specific query parameters that we want
- This return all courses with students and the instructor this [test](https://github.com/Quisui/stanbridge-api/blob/develop/tests/Feature/api/v1/controllers/CourseControllerTest.php) ->  testAllCoursesCanBeReturned() <br />
- To filter something in this case the present status we can use this [test](https://github.com/Quisui/stanbridge-api/blob/develop/tests/Feature/api/v1/controllers/CourseControllerTest.php) -> testAllCoursesCanHaveQueryFilters() <br />
 - for example with an specific instructor or maybe paginate or limit the pagination <br />
 - Examples: <br />
  - perPage = 5 <br />
  - instructor = 1 <br />
  - present = true|false <br />
- to update the Present status of a student in a course we use this [test](https://github.com/Quisui/stanbridge-api/blob/develop/tests/Feature/api/v1/controllers/CourseControllerTest.php) -> testPresentStatusCanBeUpdatedInCourse() <br />
    check [request](https://github.com/Quisui/stanbridge-api/blob/develop/app/Http/Requests/UpdateCourseRequest.php)
- to get an specific course with his relations we used this [test](https://github.com/Quisui/stanbridge-api/blob/develop/tests/Feature/api/v1/controllers/CourseControllerTest.php) -> testPresentStatusCanBeUpdatedInCourse() <br />

# Resources not customized at this moment
# No swagger added but I've that implementation here for example [check]()
# Php insights Scores to ensure best quality code

# IDE Helper Generator for Laravel
This package generates helper files that enable your IDE to provide accurate autocompletion. Generation is done based on the files in your project, so they are always up-to-date.

