# Sử dụng image PHP chính thức
FROM php:8.2-fpm

# Cập nhật package list và cài đặt các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql bcmath mbstring tokenizer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Đặt thư mục làm việc
WORKDIR /var/www

# Sao chép toàn bộ project Laravel vào container
COPY . .

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader
