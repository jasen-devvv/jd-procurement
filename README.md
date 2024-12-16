# Laravel 11 with Docker: PostgreSQL, Redis, and Nginx

This project is a Laravel 11 setup with Docker, including PostgreSQL 17, Redis, and Nginx. It allows you to run a Laravel application without needing to install PHP, Composer, or other dependencies directly on your system.

---

## **Features**
- PHP 8.3 (FPM)
- PostgreSQL 17
- Redis
- Nginx

---

## **Folder Structure**
```plaintext
parent/
|---docker/                                         # Docker configuration
|    |---nginx
|    |    |---default.conf                          # Nginx configuration file
|    |---php
|    |    |---Dockerfile                            # Dockerfile for Laravel (PHP-FPM)
|    |---postgres
|    |    |---init.sql                              # Initial PostgreSQL database setup
|    |---redis
|    |    |---redis.conf                            # Redis configuration file
|----src/
|    |---(Laravel Project files will be here)       
|----.env                                           # Environment variables for Laravel
|----.gitignore                                     # Git ignore file
|----docker-compose.yml                             # Docker Compose configuration file
|----LICENSE                                        # License information
|----Makefile                                       # Makefile for convenience
|----README.md
```

## **Getting Started**
1. Clone the repository:
```bash
git clone https://github.com/jasen-devvv/jd-procurement.git
cd jd-procurement
```

2. Setup laravel
    1. Copy .env.example to .env inside the src directory:
    ```bash
    cp src/.env.example src/.env
    ```
    2. Modify the .env file to connect with Docker services (PostgreSQL and Redis)
    ```bash
    DB_CONNECTION=pgsql
    DB_HOST=postgres
    DB_PORT=5432
    DB_DATABASE=yourdatabase
    DB_USERNAME=yourusername
    DB_PASSWORD=yourpassword

    CACHE_DRIVER=redis
    QUEUE_CONNECTION=redis
    REDIS_CLIENT=predis
    REDIS_HOST=redis
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    ```

3. Build and start Docker containers:
```bash
make build
make up
```

4. Instal laravel dependencies
```bash
make composer cmd=install
```

5. Generate application key
```bash
make artisan cmd=key:generate
```

6. Run database migrations
```bash
make artisan cmd=migrate
```

## **Common Commands**
| Commands                  | Description                                       |
|---------------------------|---------------------------------------------------|
| make build                | Build Docker containers                           |
| make up                   | Start all containers                              |
| make down                 | Stop and remove all containers                    |
| make restart              | Restart all containers                            |
| make logs                 | View container logs                               |
| make artisan cmd=<cmd>    | Run artisan commands (e.g., migrate, route:list)  |
| make composer cmd=<cmd>   | Run composer commands (e.g., install, update)     |
| make bash                 | Access the Laravel (PHP) container                |
| make db-shell             | Access postgreSQL CLI                             |
| make redis-cli            | Access Redis CLI                                  |

## **Accessing the Application**
- The application will be available at: 
    http://localhost

## **License**
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## **Contributing**
Contributions are what make the open-source community such an amazing place to learn, inspire, and create.

## **Author**
Built with ❤️ by [Jasen](https://github.com/jasen-devvv) - feel free to contact me for