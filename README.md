# Cart App
Suppose you are making an ecommerce system where you are handling the whole development of the backend. The products you are going to sell in the website/application will have a
category for that you have to store id and name. For each
category there will be N numbers of products. Product will contain
name, price, stock, selling count, category. As a Database you
have to use arrays.


## Features
Single api to login for user and admin using username and
password. If the username is user@gmail.com and
password is 1234 then the user should be able to login as
user if admin@gmail.com and password 1234 then it should
login as admin.

Api to create (only for admin), update (only for admin),
delete (only for admin) (If there is any product in that
category then it should not delete), fetch all with search
(for all), fetch single by id for category (for all).

Api to create (only for admin), update (only for admin),
delete (only for admin) (If the product has been added to
cart then it should not be deleted), fetch all with search
(for all), fetch single by id for products (for all).

Api for adding the product to cart by user

Api for removing from cart by user

Api to increase the quantity in cart by user

## Installation
PHP 8.1 and Laravel 9 or higher are required.

First of all, install all composer files
```sh
composer install
```

## Database Configuration
To configure your Laravel application to connect to the database, update the following settings in `.env` file.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cart_app
DB_USERNAME=root
DB_PASSWORD=
```

After setting database run the following command to create all required table for the application 
```sh
php artisan migrate
```

For easy testing application come up with dummy data. Seed it.
```sh
php artisan db:seed
```

To ensure the security of the application you have to run the following command to generate a key.
```sh
php artisan key:generate
```

## Test User Account

The seed command will also create a test user accounts for your convenience. You can use the following email address to access the test account:

**Test User Email:** `admin@gmail.com`
**Test User password:** `1234`

**Test User Email:** `user@gmail.com`
**Test User password:** `1234`

Feel free to explore the application and use this test user account for testing purposes.
