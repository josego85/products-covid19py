# Build stage for FrankenPHP
FROM dunglas/frankenphp:static-builder AS builder

# Establece el directorio de trabajo
WORKDIR /go/src/app

# Copia todos los archivos de Laravel al contenedor
COPY . .

# Elimina archivos innecesarios para reducir el peso de la imagen
RUN rm -rf tests/ .git node_modules

# Instala las dependencias de Laravel
RUN composer install --ignore-platform-reqs --no-dev --optimize-autoloader

# Copia las vistas, configuraciones y recursos necesarios al binario
RUN EMBED=dist/app/ \
    PHP_EXTENSIONS=ctype,iconv,zip,pdo,pdo_mysql,mbstring,openssl,json,fileinfo \
    ./build-static.sh

# Verifica que el binario fue generado correctamente
RUN test -f dist/frankenphp-linux-x86_64 || (echo "Error: Binario no generado" && exit 1)

# Final stage: Imagen ligera basada en Alpine
FROM alpine:3.19.0

# Instala dependencias mínimas necesarias
RUN apk add --no-cache ca-certificates bash

# Establece el directorio de trabajo
WORKDIR /app

# Copia el binario generado desde la etapa de construcción
COPY --from=builder /go/src/app/dist/frankenphp-linux-x86_64 /app/frankenphp-laravel

# Copia el archivo Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

# Configura permisos para los logs y los directorios de Laravel
RUN mkdir -p /var/log/caddy && \
    chmod -R 775 /var/log/caddy && \
    chown -R nobody:nobody /var/log/caddy

# Expone el puerto 80 para el servidor
EXPOSE 80

# Comando de ejecución predeterminado
CMD ["./frankenphp-laravel", "php-server"]
