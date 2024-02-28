### Prerequisite

Install Docker on your local Machine and Enable the WSL2 if you are using Windows OS

### Run Steps

#### Step 1

Use this command to build your containers

```shell
docker-compose build
```

#### Step 2

Use this command to run your containers

```shell
docker-compose up -d
```

#### Step 3

Open Docker Desktop and run the terminal of task-php container then run these commands:

**Note: Don't change the order of commands!**

```shell
composer install
chmod -R 777 storage/*
cp .env.example .env
php artisan optimize:clear
php artisan migrate
php artisan db:seed
```

### Tests

To run tests use this command

```shell
php artisan test
```

Expected Results are:

```text
   PASS  Tests\Feature\Api\UserTest
  ✓ report test

  Tests:  3 passed
  Time:   2.82s

```

### APIs

Use `http://localhost/api/` as `API`

#### `POST` API/login

Login user by email and password and return token (JWT)

##### Response

```json
[
    {
        "user": {
            "name": "masoud salehi",
            "email": "masoud@gmail.com"
        },
        "token": "6|0MmNc6hOZ26SdVZTO3Bxvp9KWU58ewb2HL7Ok2k214bc8424"
    }
]
```

#### `POST` API/register

Register an user by email, name and password

##### Response

```json
[
    {
        "user": {
            "name": "masoud salehi",
            "email": "masoud@gmail.com"
        },
        "token": "6|0MmNc6hOZ26SdVZTO3Bxvp9KWU58ewb2HL7Ok2k214bc8424"
    }
]
```

#### `GET` API/todos

Get all todos tasks

##### Responses

```json
[
    {
        "title": "task1",
        "description": "description task1",
        "completed": 1,
        "user": {
            "name": "masoud salehi",
            "email": "masoud@gmail.com"
        }
    }
]
```


#### `POST` API/todos/store

Create a task based on user logged in

##### Responses

```json
{
    "title": "task1",
    "description": "description task1",
    "completed": null,
    "user": {
        "name": "masoud salehi",
        "email": "masoud@gmail.com"
    }
}
```

#### `POST` API/todos/update/

Mark as completed a todo task

##### Responses

```json
{
    "title": "task1",
    "description": "description task1",
    "completed": 1,
    "user": {
        "name": "masoud salehi",
        "email": "masoud@gmail.com"
    }
}
```
### Commands
By using ```php artisan todo:complete``` you can complete all uncompleted tasks.

Also, the platform automatically checks daily and compiles any task that has not been compiled for more than 2 days.
