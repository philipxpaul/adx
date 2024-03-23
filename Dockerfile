FROM php:8.1-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd


#previous code
# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
#RUN docker-php-ext-install 
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# BEGIN MODIFICATIONS to Adarsh Hiwrate's suggested code
# Copy existing application directory contents
# The following line is redundant (predundant?) because of the line which copies the required items with the correct permissions.
# COPY . /var/www

# Copy existing application directory permissions
WORKDIR /app
COPY . /app


# This has to come after the above copy, otherwise the code will not yet be available in the container.
RUN php artisan key:generate

# END MODIFICATIONS to Adarsh Hiwrate's suggested code

# Change current user to www
# USER www

# Expose port 9000 and start php-fpm server
EXPOSE 8000
# CMD ["php-fpm"]
# CMD php artisan serve --host=0.0.0.0 --port=8000
ENTRYPOINT ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"] 