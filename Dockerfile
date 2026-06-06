FROM php:8.2-apache

# تثبيت الإضافات والمكتبات المطلوبة لـ Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmmath

# تفعيل مود الـ Rewrite الخاص بـ Apache
RUN a2enmod rewrite

# ضبط مسار الـ DocumentRoot ليوجه لمجلد public في Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع داخل السيرفر
WORKDIR /var/www/html
COPY . .

# تثبيت مكتبات Composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# ضبط صلاحيات المجلدات لتجنب المشاكل
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]