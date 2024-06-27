# Sử dụng image PHP chính thức với phiên bản 8.2
FROM php:8.2-fpm

# Cài đặt các tiện ích hệ thống cần thiết và gói libzip-dev
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    locales \
    zip \
    unzip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Cài đặt các phần mở rộng PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www

# Sao chép file composer.json và composer.lock vào thư mục làm việc
COPY composer.json composer.lock ./

# Cài đặt các phụ thuộc của PHP
RUN composer install --prefer-dist --no-scripts --no-dev --optimize-autoloader

# Sao chép toàn bộ mã nguồn vào thư mục làm việc
COPY . .

# Thiết lập quyền cho thư mục lưu trữ và bộ nhớ cache
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Chạy lệnh để tạo khóa ứng dụng
RUN php artisan key:generate

# Expose cổng 9000 và chạy PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
