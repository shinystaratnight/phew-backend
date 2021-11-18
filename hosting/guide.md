- How to install PHP on Ubuntu 20.04
  https://www.fosstechnix.com/how-to-install-php-on-ubuntu-20-04/

- How to Completely Remove php 7 from Ubuntu 20.04 LTS
  sudo apt-get purge php7.*
  sudo apt-get autoclean
  sudo apt-get autoremove

- Configure SSL
  https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-20-04
  sudo apt install certbot python3-certbot-apache
  sudo certbot --apache

1. Install PHP  (Apache2 is also installed together)
   sudo apt install software-properties-common
   sudo add-apt-repository ppa:ondrej/php
   sudo apt update
   sudo apt -y install php7.2
   sudo apt install php7.2-common php7.2-mysql php7.2-curl php7.2-json php7.2-cgi php7.2-opcache php7.2-mbstring
   (sudo apt install php7.2-xml)

2. MYSQL
   sudo apt install mysql-server
   sudo mysql_secure_installation
   sudo mysql;
   ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'PT4?#*tE9&vsxv%6';
   FLUSH PRIVILEGES;

3. Add conf file to /etc/apache2/sites-available/.
   sudo a2enmod rewrite  # This is required. "Page not Found" occurred unless enabled rewrite module.

4. Link storage to public/storage
   php artisan storage:link
	
	
