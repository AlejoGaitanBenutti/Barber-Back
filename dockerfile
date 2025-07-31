# Usa una imagen base de PHP con servidor embebido y extensiones comunes
FROM php:8.2-cli

# Instala extensiones necesarias (ej. pdo, pdo_mysql)
RUN docker-php-ext-install pdo pdo_mysql

# Copia los archivos del backend
COPY . /app

# Cambia al directorio /app
WORKDIR /app

# Expone el puerto que Render usa (10000)
EXPOSE 10000

# Comando para iniciar el servidor embebido de PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
