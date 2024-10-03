# BTN Services

This is the back-end application for the BTN project. It's built with Laravel 11 and PHP 8.1.

## Tech Stacks

-   Laravel
-   Tymon/JWT-Auth
-   MariaDB
-   Docker

## Prerequisites

-   PHP 8.1 installed on your machine
-   Composer 2.0
-   Docker and docker-compose (opt if running MariaDB using docker)

## Installation

1. Clone the repository:

    ```bash
    git clone ttps://github.com/bimogempar/btn-services.git
    cd btn-services
    ```

1. Clone the repository:

    - Create `.env` file

1. Run the application with PHP 8.1 and Composer:

    ```bash
    composer install

    php artisan jwt:secret

    php artisan migrate

    php artisan serve
    ```

1. The app will be running at `http://localhost:8000`.

## Creadentials

-   [Postman Collection API](https://rudi-blahok.postman.co/workspace/My-Public-Workspace~6d5b6275-23ee-46ff-8d31-74761ac7484c/collection/16471792-9f507520-970c-4b30-8cea-096114df4523?action=share&creator=16471792)

## Creadentials

User:

-   email: bimo@example.com
-   pass: password
