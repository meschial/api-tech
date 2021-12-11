rm -rf /var/www/backend/public/spa
cp -R /var/www/frontend/dist /var/www/backend/public/spa
mkdir -p /var/www/backend/resources/views/spa
mv /var/www/backend/public/spa/index.html /var/www/backend/resources/views/spa/index.html