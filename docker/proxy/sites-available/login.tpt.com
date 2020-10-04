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

      rewrite ^/pma(/.*)$ $1 break;
      proxy_pass http://host.docker.internal:8101;
      proxy_http_version 1.1;
      proxy_set_header Upgrade $http_upgrade;
      proxy_set_header Connection 'upgrade';
      proxy_set_header X-Forwarded-Host $server_name;
      proxy_set_header X-Real-IP $remote_addr;
      proxy_set_header Host $host;
      proxy_cache_bypass $http_upgrade;
      # Preflighted requests
      if ($request_method = OPTIONS ) {
         add_header "Access-Control-Allow-Headers" "Authorization, Origin, X-Requested-With, Content-Type, Accept";
      }      
  }
}
