# 🧱 Stage 1: Build Vue frontend using Node 22
FROM node:22 as node-builder    
# Use official Node.js v22 image, name stage 'node-builder'

WORKDIR /app                    
# Set working directory inside container to /app

# Copy package.json and package-lock.json from host root to /app in container
COPY package*.json ./          

RUN npm install                 
# Install npm dependencies inside container

COPY . .                       
# Copy all project files into /app inside container

RUN npm run build               
# Build Vue frontend assets (output to /app/dist or configured folder)

# 🐘 Stage 2: Setup PHP environment with Laravel
FROM php:8.2-fpm                
# Use official PHP 8.2 with FastCGI Process Manager image

# Install system dependencies and PHP extensions needed by Laravel & Postgres
RUN apt-get update && apt-get install -y \
    zip unzip curl libpq-dev libzip-dev git \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer (PHP dependency manager) from official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www                
# Set working directory to /var/www for Laravel app

# Copy all files including Vue build output from node-builder stage to /var/www
COPY --from=node-builder /app /var/www

RUN composer install           
# Install PHP dependencies with Composer

RUN chown -R www-data:www-data /var/www  
# Change ownership of /var/www to www-data user and group (web server user)

EXPOSE 9000                   
# Expose port 9000 (default PHP-FPM port)

CMD ["php-fpm"]               
# Default command to run PHP FastCGI process
