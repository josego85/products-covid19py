FROM nginx:1.28-alpine

RUN apk add --no-cache \
      curl \
      vim \
      bash

RUN rm /etc/nginx/conf.d/default.conf
COPY ./docker/dev/nginx/nginx.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/log/nginx \
      /var/cache/nginx/client_temp \
      /var/cache/nginx/proxy_temp \
      /var/cache/nginx/fastcgi_temp \
    && chown -R nginx:nginx /var/log/nginx /var/cache/nginx

HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
