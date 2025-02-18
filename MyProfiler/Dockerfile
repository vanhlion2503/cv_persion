# Sử dụng image PHP chính thức
FROM php:8.2-fpm

# Cài đặt các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql gd



# Đặt thư mục làm việc
WORKDIR /var/www

# Sao chép toàn bộ project Laravel vào container
COPY . .

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader

# C
