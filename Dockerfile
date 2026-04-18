# 1. Usando la última versión ESTABLE de PHP (8.3)
FROM php:8.3-apache-bookworm

WORKDIR /var/www/html

# Instalación de herramientas necesarias y extensiones PHP
RUN apt-get update && \
    apt-get install -y \
        git \
        libxml2-dev \
        libzip-dev \
        nano \
        zip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        wkhtmltopdf \
        iputils-ping \
        # 2. LIBRERÍAS AÑADIDAS para CodeIgniter
        libicu-dev \
        libcurl4-openssl-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
        bcmath \
        opcache \
        mysqli \
        pdo \
        pdo_mysql \
        soap \
        gd \
        zip \
        # 3. EXTENSIONES AÑADIDAS para CodeIgniter
        intl \
        curl && \
    a2enmod headers rewrite && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 4. INSTALACIÓN DE CODEIGNITER
RUN composer create-project codeigniter4/appstarter . --no-interaction

# Configuración del documento raíz de Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Permisos para /tmp
RUN mkdir -p /tmp && chown www-data:www-data /tmp && chmod 0700 /tmp

# 5. PERMISOS para CodeIgniter (Crucial para /writable)
RUN chown -R www-data:www-data /var/www/html

# Reinicio del servicio Apache
RUN apachectl -k restart