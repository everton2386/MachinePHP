# Use a imagem base com PHP e Apache integrados
FROM php:8.1-apache

# Instala o driver PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Copia a configuração do Apache personalizada
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

# Define variáveis de ambiente para desativar os erros do PHP
ENV PHP_INI_DISPLAY_ERRORS=Off
ENV PHP_INI_ERROR_REPORTING="E_ALL & ~E_NOTICE"

# Aplica as configurações personalizadas do PHP no arquivo php.ini-production
RUN sed -i "s/display_errors = On/display_errors = \${PHP_INI_DISPLAY_ERRORS}/" /usr/local/etc/php/php.ini-production \
    && sed -i "s/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/error_reporting = \${PHP_INI_ERROR_REPORTING}/" /usr/local/etc/php/php.ini-production \
    && cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Habilita o módulo rewrite do Apache
RUN a2enmod rewrite

# Define o diretório de trabalho como o diretório padrão do Apache
WORKDIR /var/www/html

# Copia os arquivos da aplicação para o diretório de trabalho
COPY . .

# Comando padrão para iniciar o Apache
CMD ["apache2-foreground"]
