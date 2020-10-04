server {
    listen 443 ssl;
    server_name login.tpt.com;
    location / {
        rewrite ^/pma(/.*)$ $1 break;
        proxy_pass http://host.docker.internal:8101;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header X-Forwarded-Host $server_name;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    ssl_certificate /etc/nginx/ssl/default.crt;
    ssl_certificate_key /etc/nginx/ssl/default.key;
}

server {
  listen 80;
  listen [::]:80;
  server_name login.tpt.com;
  location / {
      add_header 'Access-Control-Allow-Origin' '*';
      add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';

      if ($request_method = 'OPTIONS') {

         #
         # Tell client that this pre-flight info is valid for 20 days
         #
         add_header 'Access-Control-Max-Age' 1728000;
         add_header 'Content-Type' 'text/plain; charset=utf-8';
         add_header 'Content-Length' 0;
         return 204;
      }
      rewrite ^/pma(/.*)$ $1 break;
      proxy_pass http://host.docker.internal:8101;
      proxy_http_version 1.1;
      proxy_set_header Upgrade $http_upgrade;
      proxy_set_header Connection 'upgrade';
      proxy_set_header X-Forwarded-Host $server_name;
      proxy_set_header X-Real-IP $remote_addr;
      proxy_set_header Host $host;
      proxy_cache_bypass $http_upgrade;
  }
}
