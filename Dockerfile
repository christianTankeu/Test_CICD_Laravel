# Prod Dockerfile
# We simply inherit the php image. This image does
# not particularly care what OS runs underneath

## Set an environment variable with the directory
## where we'll be running the app

# App container preconfig stage
FROM php:7.4-fpm as app-preconfig

USER root

## Create the directory and instruct Docker to operatefrom there
WORKDIR /var/www

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -

# Install system dependencies
RUN apt-get update \
    # gd
    && apt-get install -y --no-install-recommends build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev nodejs  \
    && docker-php-ext-configure gd  \
    && docker-php-ext-install gd \
    # gmp
    && apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp \
    # pdo_mysql
    && docker-php-ext-install pdo_mysql mbstring \
    # pdo
    && docker-php-ext-install pdo \
    # opcache
    && docker-php-ext-enable opcache \
    # zip
    && docker-php-ext-install zip \
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

#####################################
# Composer:
#####################################

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer


# Server configs
COPY local.ini /usr/local/etc/php/local.ini

COPY nginx.conf /etc/nginx/nginx.conf




## App packaging stage
FROM app-preconfig as app-package

## Create the directory and instruct Docker to operatefrom there
WORKDIR /var/www

## Copy source code
COPY . .

# Give access
RUN chmod +rwx /var/www

RUN chmod -R 777 /var/www

# Delete all env files
RUN find . -name "*.env*" -type f -delete




# App dependencies installation stage
FROM app-package as app-dependencies

## Create the directory and instruct Docker to operatefrom there
WORKDIR /var/www

RUN npm install

RUN npm rebuild node-sass

RUN npm run prod




FROM app-dependencies as app-vendor

## Create the directory and instruct Docker to operatefrom there
WORKDIR /var/www

RUN composer install

RUN composer dump-autoload

RUN php artisan config:clear

RUN php artisan config:cache



# Serving stage
FROM app-vendor as serving-stage

EXPOSE 80

RUN ["chmod", "+x", "post_deploy.sh"]

CMD [ "sh", "./post_deploy.sh" ]
