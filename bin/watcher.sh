if ! ps aux | grep -q "udp2ws-ws-service.php"  
then /usr/bin/php  /var/www/vhosts/cucos.de/ds.cucos.de/design/bin/udp2ws-ws-service.php &    
fi

