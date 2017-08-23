Using Mamp, make the public folder the document root, or navigate to the folder root in terminal and run 'php artisan serve'

The .env file has a config file with fields to connect to a database. Update those to whatever you local configuration is. 

In the terminal navigate to the project folder and run 'php artisan migrate', to build DB tables

Then run 'php artisan db:seed' to seed the user table

All request require a valid key, which can be retrieved from the users table

List of routes and methods:

GET api/v1/users - Get all users
GET api/v1/user - Get single user
POST api/v1/addproductuser/{product_id} - Attach product to requesting user
POST api/v1/deleteproductuser/{product_id} - Remove product from requesting user

GET api/v1/allproducts - List all products
GET api/v1/product/{product_id} - List product
POST api/v1/addproduct - Add a product
	fields:
		name: text
		description: text
		price: float
		image: png,jpeg
POST api/v1/updateproduct/{product_id} - Update a product
POST api/v1/deleteproduct/{product_id} - Delete a product

PHPUnit is used for testing, run 'vendor/bin/phpunit' on command line
	'vendor/bin/phpunit ExampleTest'
	'vendor/bin/phpunit ProductTest'

