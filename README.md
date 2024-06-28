# Laravel API Project with DDEV

This repository contains a Laravel project configured to run with DDEV. Follow these instructions to get the project up and running on your local machine.

## Prerequisites
- [Docker](https://www.docker.com/get-started) installed
- [DDEV](https://ddev.readthedocs.io/en/stable/#installation) installed

## Getting Started

### Extract the Project

1. Unzip the project folder:

    ```bash
    git clone https://github.com/narayanghimire/books-api.git
    ```

### Initialize DDEV

1. Start by navigating to the project directory if you haven't already:
    ```bash
    cd books-api
    ```

2. Run the following command to configure DDEV for your Laravel project:

    ```bash
    ddev start
    ```

### Database Setup

1. Install the project dependencies:

    ```bash
    ddev composer install
    ```

3. Run the database migrations:

 
    ddev artisan migrate
 
   or

    php artisan migrate

### Generating Sample data on the database

    ddev  artisan db:seed

or

        php artisan db:seed

### Running Unit test
Unit test is added for the CRUD operation interface method
```bash
ddev artisan test
```
or 
```bash
php artisan test
```
### Running the Application
Once the setup is complete, you can access the application at:
```plaintext
http://books-api.ddev.site
```
## API Documentation

### Postman Collection
you can import the Postman collection file directly to explore and test the API endpoints
Postman Collection File name ``Books_API.postman_collection.json``, exists within the root path of this
project.

### API Routes
- **Get Books by Id**
    - Method: `GET`
    - URL: `http://books-api.ddev.site/api/v1.0/books/{id}`
    - Description: Retrieve a specific book by its ID.
- **Get All Books**
    - Method: `GET`
    - URL: `http://books-api.ddev.site/api/v1.0/books`
    - Description: Retrieve all books stored in the database.

- **Create Books**
    - Method: `POST`
    - URL: `http://books-api.ddev.site/api/v1.0/books`
    - Body:
      ```json
      {
          "name": "rsdgwerffdghnvbm",
          "details": "rgwrefver",
          "author": "qregerreg"
      }
      ```
    - Description: Create a new book with the provided details.
- **Update Books**
    - Method: `PUT`
    - URL: `http://books-api.ddev.site/api/v1.0/books/{id}`
    - Body:
      ```json
      {
          "name": "hello",
          "details": "rgwrefver",
          "author": "qregerreg"
      }
      ```
    - Description: Update an existing book with the provided details.

- **Delete Books**
    - Method: `DELETE`
    - URL: `http://books-api.ddev.site/api/v1.0/books/{id}`
    - Description: Delete a book by its ID.
