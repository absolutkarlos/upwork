# Submission API

This Laravel project provides a simple API endpoint to handle form submissions.

## Setup

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan migrate` to create the necessary database tables.
5. (Optional) Configure your queue driver in `.env` if you want to use queues.

## Testing

You can test the API using a tool like Postman or Insomnia.

* **Endpoint:** `POST /api/submissions`
* **Payload:**
    ```
    {
        "name": "John Doe",
        "email": "john.doe@example.com",
        "message": "This is a test message."
    }
    ```
* **Expected Response (Success):**
    ```
    {
        "message": "Submission received. It will be processed shortly."
    }
    ```
    * Status code: 202 Accepted

* **Expected Response (Validation Errors):**
    ```
    {
        "errors": { ... }
    }
    ```
    * Status code: 422 Unprocessable Entity