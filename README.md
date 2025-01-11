## Email API
Welcome to **Email API**! This project shows Laravel's capabilities, including routing, migrations, seeders, and the Mail feature. It is easy setup and test with clear configuration guidelines.

## Project Overview
The Email API is a Laravel-based project designed to facilitate sending emails to senators. It accepts user-submitted data through an API endpoint and sends an email to a senator based on their ID. The senator must exist in the database, and all fields must be validated for the email to be sent.


## Technologies Used
- **Laravel Framework**: PHP framework used for building the API.
- **MySQL**: Database for storing senator data.
- **PHP**: Backend programming language used with Laravel.

## Prerequisites
Ensure you have the following installed in your machine
- **php** 7.3
- **laravel framework** v8 

### Setup
1. Clone the repository.
2. Create your DB with the sql `example.sql`.
3. Copy the file `.env.example` to `.env` and configure it with:
    - Config the next data  
    ```
    DB_CONNECTION=mysql
    DB_HOST=HOST_TO_MYSQL_INSTANCE # 127.0.0.1 
    DB_PORT=PORT_TO_MYSQL_INSTANCE # 3306
    DB_DATABASE=DATABASE_NAME # my_database
    DB_USERNAME=DATABASE_USERNAME # my_username
    DB_PASSWORD=USERNAME_PASSWORD # ****
    ```
    - Config the next data with your connection to your email service. The next example is using a mailtrap account.
    ```
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=mailtrap_username
    MAIL_PASSWORD=mailtrap_password
    MAIL_ENCRYPTION=tls
    ```

4. Start the server using `php artisan serve`.

### Endpoints
- POST `/api/send-email`: Sends an email to a senator.

### Testing
Having in mind that your localhost name is http://127.0.0.1:8000 for testing the endpoint it would be like this with ```curl```:

```
curl --location 'http://127.0.0.1:8000/api/send-email' \
--header 'Content-Type: application/json' \
--data-raw '{
    "senator_id": 1,
    "last_name": "Scholl",
    "email": "huei930624+test1@gmail.com",
    "message": "This is a message to the senator."
}
'
```

Test calling the endpoint http://127.0.0.1:8000/api/send-email on postman. Select POST as the method and add the following json on the body raw.

```
{
    "senator_id": 1,
    "last_name": "Scholl",
    "email": "huei930624+test1@gmail.com",
    "message": "This is a message to the senator."
}
```

### License
This project is open-source and available under the MIT License.

### Contributors
[Isabel Scholl](https://github.com/isabelhuerta24)
