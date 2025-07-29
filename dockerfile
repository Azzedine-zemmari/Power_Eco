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

# 🐘 Stage 2: PHP with Laravel
FROM php:8.2-fpm

# Install system dependencies + required PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip curl libpq-dev libzip-dev git libpng-dev \
    && docker-php-ext-install pdo pdo_pgsql zip gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy all files including built Vue from Node stage
COPY --from=node-builder /app /var/www

# Install Laravel PHP dependencies
# RUN composer install

# Set proper ownership
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
