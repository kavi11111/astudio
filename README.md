# ASTUDIO Laravel API Assessment

This is a Laravel-based API for managing users, projects, timesheets, dynamic attributes,and EAV Implementation.

## Setup Instructions

1.  **Clone the Repository**:
    ```bash
    git clone https://github.com/kavi11111/astudio.git
    cd astudio
    ```
2.  **Install Dependencies**:
    composer install
    npm install

3.  **Set Up the Environment**:
    ->Copy the .env.example file to .env:
    cp .env.example .env

    ->Update the .env file with your database credentials.
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

    ->Generate Application Key:
    php artisan key:generate

    ->Import the Provided SQL Dump(in root directory):
    mysql -u your_database_user -p your_database_name < database.sql

    ->Start the Development Server:
    php artisan serve

4.  **Test Credentials**:
    `markdown`

    ## Test Credentials

    -   **email**: `kavi@gmail.com`
    -   **password**: `qwertyuiop`

5.  **API Documentation & Example requests/responses**:

    **After logging in, you will receive an access token. This token must be included in the Authorization header of all subsequent requests to access protected endpoints.**

    ->Using the Access Token

    -   Include the access token in the Authorization header of all protected requests:
    -   Authorization: Bearer <access_token>
    -   Example: curl -X GET http://127.0.0.1:8000/api/projects \
        -H "Accept: application/json" \
        -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."

    ->Authentication:

    **Register a User**
    Endpoint: POST /api/register
    Request:
    {
    "first_name": "Naseem",
    "last_name": "Shah",
    "email": "naseem@gmail.com",
    "password": "password123"
    }

        Response:
        {
        "message": "User registered successfully",
            "user": {
                "first_name": "Naseem",
                "last_name": "Shah",
                "email": "naseem@gmail.com",
                "updated_at": "2025-03-16T13:02:10.000000Z",
                "created_at": "2025-03-16T13:02:10.000000Z",
                "id": 2
            }
        }

    **Log In**
    Endpoint: POST /api/login
    Request:{
    "email": "kavi@gmail.com",
    "password": "qwertyuiop"
    }

        Response:
        {
            "message": "Login successful",
            "user": {
                "id": 1,
                "first_name": "kavi",
                "last_name": "yarasan",
                "email": "kavi@gmail.com",
                "email_verified_at": null,
                "created_at": "2025-03-16T07:20:42.000000Z",
                "updated_at": "2025-03-16T07:20:42.000000Z"
            },
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDliOTljYmU4OGJiMDU0MzcwMTk0NjY4MTQ5M2VlNDg3ODk3NzQ0MmJlMzc4Y2I4MjE2OGM3YTAzMTVlYmViNDUwYzU1NTk1OGFhMDg1YzEiLCJpYXQiOjE3NDIxMjA3NzYuMTMyNjM2LCJuYmYiOjE3NDIxMjA3NzYuMTMyNjQxLCJleHAiOjE3NzM2NTY3NzUuNjY4MDQyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Gpx476vFKCjZvm3oST7BRq1acEh0IoquJPru4UYXMKPv3romwm36PAzAqnZnZbLhKBQZDtyoL2NZPUXmsW-pPJf8S8TJxJeZcpZs8aoOcxXfplePd_-0BXpjiqWRdv5bYmHyP_ssq80zyZ1VejuesuoMB3OwN5zTnwkxW-vPkggvnVxzXWwy1CJZCO7aZ_zB6d_db7B_mBRC9ZX8wuW87gAG5b6NiedBuq6xmr1XeMVNT6dEzGmdnEKRnPAVdi8zXbTzJPgPEjziISCc3sngPG9zq30_A5ADd0SRYrsP14DxlxFUgbx1O8T-zYFA1ufJj6unAfwR-CgHI-2sJ5_iy-ewIgM_4GDmPqn5jouEmzI7VspS418PlYPWluErjhCH9tq2Qe4SVdTzC-ciYemW395SNY5UO8LE8cAMBcIgiLDjLWDjrVNfQHtrocchxH6JySwLZT5mP7LRoLy7tRedzeAmLqqe1Z23RJrnSxwV8tScgEH9WG8agU-AtG0hDTgoX5NixHrAncS3FzMR4uTvk9hyi8kaT4Q8i8rIhoVZltDsk4m1qlLXMhI0cM3dKOtMcuooIgM9sThNN5mK-WXrWPUql8sy4ic5qebNdHxQAPKlFd445qQNI_WRcs4KP7rne-PpJcxGY1wFWVKYlwQeQnrWBSFufSXMelRg_i1mBK4"
        }

    -> Attribute
    **Add Attribute**

        Endpoint: POST /api/attributes
        Request:{
            "name": "department",
            "type": "text"
        }

        Response:{
            "name": "department",
            "type": "text",
            "updated_at": "2025-03-16T10:53:32.000000Z",
            "created_at": "2025-03-16T10:53:32.000000Z",
            "id": 2
        }

    **Delete Attribute**

        Endpoint: DELETE /api/attributes/1
        Response: 204 No Content

    -> Projects
    **Add projects**

        Endpoint: POST /api/projects
        Request:{
            "name": "Rolex",
            "status": "active",
            "attributes": [
                {
                    "attribute_id": 2,
                    "value": "Branding"
                },
                {
                    "attribute_id": 3,
                    "value": "Ongoing"
                }
            ]
        }

        Response:{
            "name": "Rolex",
            "status": "active",
            "updated_at": "2025-03-16T10:59:19.000000Z",
            "created_at": "2025-03-16T10:59:19.000000Z",
            "id": 1,
            "attribute_values": [
                {
                    "id": 1,
                    "attribute_id": 2,
                    "value": "Branding",
                    "created_at": "2025-03-16T10:59:19.000000Z",
                    "updated_at": "2025-03-16T10:59:19.000000Z",
                    "entity_id": 1,
                    "attribute": {
                        "id": 2,
                        "name": "department",
                        "type": "text",
                        "created_at": "2025-03-16T10:53:32.000000Z",
                        "updated_at": "2025-03-16T10:53:32.000000Z"
                    }
                },
                {
                    "id": 2,
                    "attribute_id": 3,
                    "value": "Ongoing",
                    "created_at": "2025-03-16T10:59:19.000000Z",
                    "updated_at": "2025-03-16T10:59:19.000000Z",
                    "entity_id": 1,
                    "attribute": {
                        "id": 3,
                        "name": "status",
                        "type": "text",
                        "created_at": "2025-03-16T10:56:13.000000Z",
                        "updated_at": "2025-03-16T10:56:13.000000Z"
                    }
                }
            ]
        }

    **Get Project**

    Endpoint: GET /api/projects/2
    Response:{
    "id": 2,
    "name": "Arrow",
    "status": "active",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:01:07.000000Z",
    "attribute_values": [
    {
    "id": 3,
    "attribute_id": 2,
    "value": "Ads",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:01:07.000000Z",
    "entity_id": 2,
    "attribute": {
    "id": 2,
    "name": "department",
    "type": "text",
    "created_at": "2025-03-16T10:53:32.000000Z",
    "updated_at": "2025-03-16T10:53:32.000000Z"
    }
    },
    {
    "id": 4,
    "attribute_id": 3,
    "value": "Pending",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:01:07.000000Z",
    "entity_id": 2,
    "attribute": {
    "id": 3,
    "name": "status",
    "type": "text",
    "created_at": "2025-03-16T10:56:13.000000Z",
    "updated_at": "2025-03-16T10:56:13.000000Z"
    }
    }
    ]
    }

    **Update Project**
    Endpoint: PUT /api/projects/2
    Request:{
    "name": "Arrow",
    "status": "completed",
    "attributes": [
    {
    "attribute_id": 2,
    "value": "Ads"
    },
    {
    "attribute_id": 3,
    "value": "Completed"
    }
    ]
    }
    Response:{
    "id": 2,
    "name": "Arrow",
    "status": "completed",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:05:33.000000Z",
    "attribute_values": [
    {
    "id": 3,
    "attribute_id": 2,
    "value": "Ads",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:01:07.000000Z",
    "entity_id": 2,
    "attribute": {
    "id": 2,
    "name": "department",
    "type": "text",
    "created_at": "2025-03-16T10:53:32.000000Z",
    "updated_at": "2025-03-16T10:53:32.000000Z"
    }
    },
    {
    "id": 4,
    "attribute_id": 3,
    "value": "Completed",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:49:54.000000Z",
    "entity_id": 2,
    "attribute": {
    "id": 3,
    "name": "status",
    "type": "text",
    "created_at": "2025-03-16T10:56:13.000000Z",
    "updated_at": "2025-03-16T10:56:13.000000Z"
    }
    }
    ]
    }

    ->TimeSheet
    **Add TimeSheet**
    Endpoint: POST /api/timesheets
    Request:{
    "task_name": "Scripting",
    "date": "2025-03-16",
    "hours": 8,
    "user_id": 1,
    "project_id": 2
    }
    Response:{
    "task_name": "Scripting",
    "date": "2025-03-16",
    "hours": 8,
    "user_id": 1,
    "project_id": 2,
    "updated_at": "2025-03-16T12:26:22.000000Z",
    "created_at": "2025-03-16T12:26:22.000000Z",
    "id": 1,
    "user": {
    "id": 1,
    "first_name": "kavi",
    "last_name": "yarasan",
    "email": "kavi@gmail.com",
    "email_verified_at": null,
    "created_at": "2025-03-16T07:20:42.000000Z",
    "updated_at": "2025-03-16T07:20:42.000000Z"
    },
    "project": {
    "id": 2,
    "name": "Arrow",
    "status": "completed",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:05:33.000000Z"
    }
    }

    **Get Timesheet for User**
    Endpoint: GET /api/timesheets/1
    Response:{
    "id": 1,
    "task_name": "Scripting",
    "date": "2025-03-16",
    "hours": "8.00",
    "user_id": 1,
    "project_id": 2,
    "created_at": "2025-03-16T12:26:22.000000Z",
    "updated_at": "2025-03-16T12:26:22.000000Z",
    "user": {
    "id": 1,
    "first_name": "kavi",
    "last_name": "yarasan",
    "email": "kavi@gmail.com",
    "email_verified_at": null,
    "created_at": "2025-03-16T07:20:42.000000Z",
    "updated_at": "2025-03-16T07:20:42.000000Z"
    },
    "project": {
    "id": 2,
    "name": "Arrow",
    "status": "completed",
    "created_at": "2025-03-16T11:01:07.000000Z",
    "updated_at": "2025-03-16T11:05:33.000000Z"
    }
    }

---

### **Conclusion**

By explicitly mentioning how to use the access token in the `Authorization` header, you make it clear to users how to authenticate their requests. This improves the usability of your API documentation. Let me know if you need further assistance! 😊
