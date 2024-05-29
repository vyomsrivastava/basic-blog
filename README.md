# Basic Blog With CRUD

The application uses PHP, MySQL, Apache and Laravel. Please make sure you have all the prerequisites.

## How to run the project?

### Step -1: Installing Dependencies

Clone the project and once you're inside the project copy and paste `.env.example` and rename it to `.env` . After that use phpMyAdmin or MySQLWorkbench and create two databases with the following names:

* basic_blog // FOR PROD
* basic_blog_testi // FOR TESTING

Now replace all the details in `.env` and `.env.testing` with the database credentials. Like -> DB_CONNECTION, DB_HOST, etc.

*NOTE:* The `.env.testing` is used by our test cases

Once done, now run `composer install` command to install all the dependencies and then run `php artisan migrate` to migrate all tables and create an admin user.

### Step -2: Checking out the project

After everything is done, you need check your localhost to see if everything is working or not. So just visit http://localhost/basic-blog and you should be able to see the project running!

## Code Explanation

The whole project follows the MVC structure. That means for database transactions we have Models, for frontend we have Views and for logics we have Controller.

### Controllers

There are two main controllers in the project:

#### AdminController

This controller handles the logic for login and logout only. There for it only has two functions that are `login` and `logout`

##### Blog Controller

This controller handles all the requests regarding the blog's CRUD and has below functions:

* `returnBlogList` : Returns blog list and shows them on index page
* `createArticle` : Returns the create article page
* `storeArticle` : Responsible for inserting the article in the db. It also performs validations
* `editArticle` : Returns the view for editing an article
* `updateArticle` : Responsible for validating the input and then updates the article based on changes
* `deleteArticle` : Deletes an article and return 404 if passed incorrect ID
* `articleDetail` : Returns the details of an article with the view

### Routes

All the routes are present in `routes/web.php`. Some of the routes are publically accessible while some of the routes have middleware `auth` so that it can be usedonly by logged in users.

#### How to run test commands?

All the controllers has their own tests. Majorily, you will find two test files located at: `tests/Feature/` are `BlogControllerTest` and `AdminControllerTest`

To execute the tests make sure you have `basic_blog_test` database created. If it's created then just run `php artisan test --env=testing`

The command will pick the credentials from `.env.testing` so please make sure that the file is updated with correct credentials.
  

