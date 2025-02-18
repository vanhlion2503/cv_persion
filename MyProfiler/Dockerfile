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
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql gd bcmath mbstring tokenizer

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt quyền thực thi cho Composer
RUN chmod +x /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www

# Sao chép toàn bộ project Laravel vào container
COPY . .

# Đảm bảo quyền sở hữu thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy file cấu hình environment nếu chưa có
RUN cp .env.example .env || true

# Tạo key cho Laravel
RUN php artisan key:generate

# Migrate database (có thể tắt nếu muốn tự chạy tay)
RUN php artisan migrate --force

# Chạy Laravel queue (nếu có sử dụng)
CMD php artisan queue:work & php-fpm
