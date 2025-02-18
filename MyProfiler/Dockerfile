# Sử dụng image PHP chính thức
FROM php:8.2-fpm

# Cập nhật và cài đặt các package hệ thống trước
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài đặt các phần mở rộng PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql gd bcmath mbstring tokenizer
