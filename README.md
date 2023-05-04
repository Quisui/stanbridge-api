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
<img width="800" alt="image" src="https://user-images.githubusercontent.com/22399803/236296588-d12687f6-ea4c-48fc-8829-aef6f81bf71f.png">

# Relations 
[Instructor](https://github.com/Quisui/stanbridge-api/blob/develop/app/Models/Instructor.php) <br />
- Has many courses <br />
- Has many through student and courses <br />

[Courses](https://github.com/Quisui/stanbridge-api/blob/develop/app/Models/Course.php) <br />
- Belongs to instructor <br />
- Belongs to many students <br />

[Student](https://github.com/Quisui/stanbridge-api/blob/develop/app/Models/Student.php) <br />
- Belongs to many courses <br />
- Has many instructors through Instructor and Course <br />

# Courses - [Controller](https://github.com/Quisui/stanbridge-api/blob/master/app/Http/Controllers/CourseController.php) 
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

# [CI/CD](https://github.com/Quisui/stanbridge-api/blob/master/.github/workflows/laravel.yml)
At this moment I keep it simple, just run my tests and then we can add a docker build for example

One test has conflicts with workflow, check image below to see in local environment, remove the $this->markTestSkipped() to check all tests <br />
<img width="603" alt="image" src="https://user-images.githubusercontent.com/22399803/236224598-6eb8ca9d-b44c-4ac1-9360-1d1900b426bb.png">

# Resources not customized at this moment
# No swagger added but I've that implementation here for example [check](https://github.com/Quisui/buckhill-challenge/blob/master/app/Http/Controllers/Controller.php) on the begining of the controller code
# Php insights Scores to ensure best quality code
<img width="600" alt="image" src="https://user-images.githubusercontent.com/22399803/236127110-a1920046-cb47-4feb-8149-6b906d3ee0f7.png">

# IDE Helper Generator for Laravel
This package generates helper files that enable your IDE to provide accurate autocompletion. Generation is done based on the files in your project, so they are always up-to-date.
[Package](https://github.com/barryvdh/laravel-ide-helper)

