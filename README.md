# booksApi

## Scenario

We are an online retailer specialising in technology books.

We have a legacy system which is proving difficult to maintain and currently has no test coverage that we are looking to replace.

We are looking to build a RESTful json API.

You have been tasked with developing a proof of concept that can demonstrate best practices in modern web development
 with a focus on designing something which is maintainable and testable.
 
This proof of concept will allow a user to:
1) Filter books by author and/or category
2) Create new books

## Getting started

You'll need to get the mysql database up and running: 
    
    $ docker-compose up -d

Now migrate the data:

    $ php artisan migrate

Now let's start laravel web service (demonised):

    $ php artisan serve &

Let's run some tests:

    $ composer test

## Todo

- Replace with separate categories model, database table and relationships with the existing books model
- Complete the behat FeatureContext
