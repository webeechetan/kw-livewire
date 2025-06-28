FROM php:8.3.10

# Install system dependencies and PHP extensions required for Laravel
RUN apt-get update -y && \
    apt-get install -y --no-install-recommends zip unzip git libzip-dev && \
    docker-php-ext-install pdo pdo_mysql zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy your application code (optional, for build context)
COPY . /app

# Install PHP dependencies
RUN composer install

# Expose port 8000 for Laravel's built-in server
EXPOSE 8000