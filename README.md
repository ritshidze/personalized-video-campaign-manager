# Personalized Video Campaign Manager

This project is a robust personalized video campaign manager specifically designed for personalized video campaigns. The system is API-driven, allowing clients to programmatically create campaigns and populate them with user data. The system is built using Laravel and MySQL.

## Table of Contents

- [Project Setup and Installation](#project-setup-and-installation)
  - [Docker Instructions](#docker-instructions)
- [API Documentation](#api-documentation)
  - [Create a New User](#create-a-new-user)
  - [Create a New Client](#create-a-new-client)
  - [Create a New Campaign](#create-a-new-campaign)
  - [Add User Data to a Campaign](#add-user-data-to-a-campaign)
- [Background Job System](#background-job-system)
- [Additional Information](#additional-information)

## Project Setup and Installation

### Prerequisites

- Docker and Docker Compose

### Docker Instructions

1. **Clone the repository**:
    ```bash
    git clone https://github.com/ritshidze/personalized-video-campaign-manager.git
    cd personalized-video-campaign-manager
    ```

2. **Docker configuration**:
    Ensure you have a `docker-compose.yml` file in the root of your project.

3. **Dockerfile**:
    Ensure you have a `Dockerfile` file in the root of your project.

4. **The docker/entrypoints.sh**:
    Ensure you have a `docker/entrypoint.sh` file in the root of your project. This bash script with run all the necessory artisan commands for you, migrations, etc.
   
5. **the .env file**:
    Ensure you have a `.env file` file in the root of your project.
    ```bash
    cp .env.example .env
    ```
    
7. **Build Docker containers**:
    ```bash
    docker-compose build
    ```

8. **Run Docker**:
    ```bash
    docker-compose up -d
    ```
9. **Open your browser and visit http://localhost:8001/**
   Ensure that you see the laravel 11 welcme/landing page.


## API Documentation

### Create a New User

- **Endpoint**: `POST /api/user/store`
- **Request Body**:
    ```json
    {
        "name":"John",
        "email": "john@example.com",
        "password": "hispassword",
        "password_confirmation": "hispassword"
    }
    ```
- **Response**:
    ```json
    {
        "name": "John",
        "email": "john@example.com",
        "updated_at": "2024-06-19T06:50:00.000000Z",
        "created_at": "2024-06-19T06:50:00.000000Z",
        "id": 1
    }
    ```

### Create a New Client

- **Endpoint**: `POST /api/client/store`
- **Request Body**:
    ```json
    {
        "name": "Super Awesome Client",
        "email": "superawesome@gmail.com"
    }
    ```
- **Response**:
    ```json
    {
        "name": "Super Awesome Client",
        "email": "superawesome@gmail.com",
        "updated_at": "2024-06-19T06:52:23.000000Z",
        "created_at": "2024-06-19T06:52:23.000000Z",
        "id": 1
    }
    ```

### Create a New Campaign

- **Endpoint**: `POST /api/campaigns`
- **Request Body**:
    ```json
    {
        "client_id": 1,
        "name": "The Cool Campaign",
        "start_date": "2024-06-20"
    }
    ```
- **Response**:
    ```json
    {
        "client_id": 1,
        "name": "Olympics Games",
        "start_date": "2024-06-20",
        "updated_at": "2024-06-19T06:56:07.000000Z",
        "created_at": "2024-06-19T06:56:07.000000Z",
        "id": 1
    }
    ```

### Add User Data to a Campaign

- **Endpoint**: `POST /api/campaigns/{campaign_id}/data`
- **Request Body**:
    ```json
    {
        "data": [
            {
                "user_id": "1",
                "video_url": "https://www.youtube.com/watch?v=tO01J-M3g0U",
                "custom_fields": {
                  "test_field0": "test 123",
                  "test_field2": "123 test"
                }
            },
            {
                "user_id": "1",
                "video_url": "https://www.youtube.com/watch?v=7bOptq-NPJQ",
                "custom_fields": {
                  "test_field0": "Hellow 123",
                  "test_field2": "Hellow world",
                  "test_field3": "Hellow Test test"
                }
            },
            {
                "user_id": "1",
                "video_url": "https://www.youtube.com/watch?v=EJr3uAQwGek"
            }
        ]
    }
    ```
- **Response**:
    ```json
    {
        "message": "Campaign user data added successfully"
    }
    ```

## Background Job System

The system uses Laravel Queues to handle data storage asynchronously, ensuring efficient processing.

### Queue Configuration

- **Queue Connection**: `database`
- **Environment Configuration**: Update the `.env` file to set up the queue connection. NB already done for you by entrypoint.sh script.
    ```env
    QUEUE_CONNECTION=database
    ```

### Running the Queue Worker

To process the jobs in the queue, hit the api/campaigns/{campaign_id}/data endpoint and run:
```bash
docker logs laravel-queue
```

## Additional Information

Please make sure that port 8001 and 3307 are free or not used,we running laravel webserver on 8001 and mysql on 3307. 
Please follow the api order to test this application ie. create a user, create client,create, campaign and lastly add compaign user data. 
