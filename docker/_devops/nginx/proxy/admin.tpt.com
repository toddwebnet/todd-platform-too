server {
    listen 443 ssl;
    server_name admin.tpt.com;
    location / {
        rewrite ^/pma(/.*)$ $1 break;
        proxy_pass http://host.docker.internal:8103;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header X-Forwarded-Host $server_name;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    ssl_certificate /etc/nginx/ssl/admin.tpt.com.pem;
    ssl_certificate_key /etc/nginx/ssl/admin.tpt.com-key.pem;
}

server {
    listen 80;
    server_name admin.tpt.com;
    return 301 https://$host$request_uri;
}
