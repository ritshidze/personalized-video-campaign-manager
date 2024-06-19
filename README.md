# Campaign Management System

This project is a robust campaign management system specifically designed for personalized video campaigns. The system is API-driven, allowing clients to programmatically create campaigns and populate them with user data. The system is built using Laravel and MySQL.

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
- Composer
- Node.js and npm

### Docker Instructions

1. **Clone the repository**:
    ```bash
    git clone https://github.com/yourusername/campaign-management.git
    cd campaign-management
    ```

2. **Create the Docker configuration**:
    Ensure you have a `docker-compose.yml` file in the root of your project:
    ```yaml
    version: '3.8'
    services:
      app:
        build:
          context: .
          dockerfile: Dockerfile
        ports:
          - "8000:8000"
        volumes:
          - .:/var/www/html
        networks:
          - app-network
      db:
        image: mysql:5.7
        ports:
          - "3306:3306"
        environment:
          MYSQL_DATABASE: campaign_management
          MYSQL_ROOT_PASSWORD: root
        networks:
          - app-network
    networks:
      app-network:
        driver: bridge
    ```

3. **Create a Dockerfile**:
    ```dockerfile
    FROM php:8.0-fpm
    WORKDIR /var/www/html

    RUN apt-get update && apt-get install -y \
        build-essential \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        curl \
        unzip \
        git \
        && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

    COPY . .

    RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

    RUN composer install

    EXPOSE 9000
    CMD ["php-fpm"]
    ```

4. **Start Docker containers**:
    ```bash
    docker-compose up -d
    ```

5. **Run migrations**:
    ```bash
    docker-compose exec app php artisan migrate
    ```

### Local Development Setup

1. **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

2. **Create an environment file**:
    ```bash
    cp .env.example .env
    ```

3. **Generate an application key**:
    ```bash
    php artisan key:generate
    ```

4. **Run migrations**:
    ```bash
    php artisan migrate
    ```

5. **Build assets with Vite**:
    ```bash
    npm run build
    ```

6. **Start the local development server**:
    ```bash
    php artisan serve
    ```

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
- **Environment Configuration**: Update the `.env` file to set up the queue connection.
    ```env
    QUEUE_CONNECTION=database
    ```

### Running the Queue Worker

To process the jobs in the queue, run the following command:
```bash
php artisan queue:work
