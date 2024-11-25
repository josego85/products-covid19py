# Usa una imagen base ligera con soporte para FrankenPHP
FROM alpine:3.19.0

# Instala dependencias mínimas necesarias
RUN apk add --no-cache ca-certificates bash

# Establece el directorio de trabajo
WORKDIR /app

# Copia el binario generado
COPY frankenphp-laravel /app/frankenphp-laravel

# Copia todos los archivos del proyecto Laravel
COPY . /app

# Da permisos de ejecución al binario y al directorio
RUN chmod +x /app/frankenphp-laravel && \
    chmod -R 775 /app/storage /app/bootstrap/cache && \
    chown -R nobody:nobody /app/storage /app/bootstrap/cache

# Copia el archivo Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

# Configura permisos para logs
RUN mkdir -p /var/log/caddy && chmod -R 775 /var/log/caddy

# Expone el puerto 80
EXPOSE 80

# Comando predeterminado
CMD ["./frankenphp-laravel", "php-server"]
