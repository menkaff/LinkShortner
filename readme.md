# LinkShortner

In this project we try to use needed technologies to achieve best result.
Technologies : Docker , PHP/Laravel , Mysql , Redis , K6 load testing
First clone project from git
Then run this command
`docker run --rm \ -v $(pwd):/opt \ -w /opt \ laravelsail/php80-composer:latest \ composer install`
Then
`sail up`
And then
`sail artisan migrate`
Finally
`sail artisan module:seed ShortnerLink`
Now you can run k6 tests in
`tests/K6`
Or Run Feature Tests in `Modules/ShortnerLink/Tests/Feature/LinkTest.php` with this command

    sail test

You can use generated Postman in
http://0.0.0.0:8084/docs/collection.json
Or even use
http://0.0.0.0:8084/docs/
for generated API documentation

If you want to regenerate the Documents remember to use php 7.4 with this command

    php artisan apidoc:generate

And check this file ( vendor/composer/platform_check.php ) line 7 be like this

    if (!(PHP_VERSION_ID >= 70400))

Since this (https://github.com/mpociot/laravel-apidoc-generator) strong packages still does not support PHP8

##

**Notes**

-   Storing and retrieving short links is based on this algorithm and code example and converting ID from base 10 to base 62 , and for security reasons there is no connection between short link and main link
-   Link Seeder does not using factory because of complexity of making links based on algorithm I can't use States in LinkFactory ( only tests use LinkFactory)
-   This project uses https://github.com/nWidart/laravel-modules/
-   There is also a short link retriver using query in Database and if you see K6 load tests , you can see used algorith is a little bit faster with 1000 VUS and 10s time => image link : http://0.0.0.0:8084/k6.png
