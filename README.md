# Personalized Video Campaign Manager

This project is a robust personalized video campaign manager specifically designed for personalized video campaigns. The system is API-driven, allowing clients to programmatically create campaigns and populate them with user data. The system is built using Laravel and MySQL.

## Table of Contents

- [Project Setup and Installation](#project-setup-and-installation)
  - [Docker Instructions](#docker-instructions)
- [API Documentation](#api-documentation)
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

5. **Build Docker containers**:
    ```bash
    docker-compose build
    ```

6. **Run Docker**:
    ```bash
    docker-compose up -d
    ```
7. **Open your browser and visit http://localhost:8001/**
   Ensure that you see the laravel 11 welcme/landing page.


## API Documentation

### Create a New Campaign

- **Endpoint**: `POST /api/campaigns`
- **Request Body**:
    ```json
    {
        "client_id": 1,
        "name": "Spring Sale Campaign",
        "start_date": "2024-06-01",
        "end_date": "2024-06-30"
    }
    ```
- **Response**:
    ```json
    {
        "id": 1,
        "client_id": 1,
        "name": "Spring Sale Campaign",
        "start_date": "2024-06-01",
        "end_date": "2024-06-30",
        "created_at": "2024-06-18T12:34:56.000000Z",
        "updated_at": "2024-06-18T12:34:56.000000Z"
    }
    ```

### Add User Data to a Campaign

- **Endpoint**: `POST /api/campaigns/{campaign_id}/data`
- **Request Body**:
    ```json
    {
        "data": [
            {
                "user_id": "user123",
                "video_url": "https://example.com/video1.mp4",
                "custom_fields": {
                    "name": "John Doe",
                    "email": "john@example.com"
                }
            },
            {
                "user_id": "user124",
                "video_url": "https://example.com/video2.mp4"
            }
        ]
    }
    ```
- **Response**:
    ```json
    {
        "message": "Data added successfully"
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
