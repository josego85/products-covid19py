FROM nginx:1.28-alpine

RUN apk add --no-cache \
      curl \
      vim \
      bash

# Remove default config
RUN rm /etc/nginx/conf.d/default.conf

# Create necessary directories with correct permissions
RUN mkdir -p \
    /var/log/nginx \
    /var/cache/nginx/client_temp \
    /var/cache/nginx/proxy_temp \
    /var/cache/nginx/fastcgi_temp \
    /var/run/nginx \
    && chown -R nginx:nginx \
        /var/log/nginx \
        /var/cache/nginx \
        /var/run/nginx \
        /etc/nginx

# Copy nginx configuration
COPY --chown=nginx:nginx ./docker/prod/nginx/nginx.conf /etc/nginx/nginx.conf

# Update nginx.conf to use non-root configuration
RUN sed -i 's|user nginx|pid /var/run/nginx/nginx.pid|' /etc/nginx/nginx.conf

# Switch to non-root user
USER nginx

HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]