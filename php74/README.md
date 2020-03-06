# DDD Code Samples - PHP v7.4

## Docker Container Management

Build the PHP container or restart it the container was in a stopped state
```
> docker-compose up -d
```

Stop the container (does not remove the container volume)
```
> docker-compose stop 
```

Start a previously stopped container
```
> docker-compose start 
```

Stop and remove the container volume (will get built again when `docker-composer up -d` is run)
```
> docker-compose down
```

Rebuild the container (required if any of the Dockerfiles have been changed)
```
> docker-compose up -d --build
```

### Run commands in Docker
```
> docker exec <container name/ID> <command to run>
```

## Install PHP Composer Packages
```
> docker exec -it ddd-code-sample-php74 composer install
```

## Run Tests
```
> docker exec -it ddd-code-sample-php74 php vendor/bin/phpunit tests/Warranty/*
```

## Debugging PHP
For some reason xdebug will not connect to PHPStorm using the host IP address that docker creates (e.g. 192.168.192.1).

A solution on MacOS is to create an alias IP to your host machine's localhost and tell xdebug to use that IP.
The php docker config expects this IP to be `10.254.254.254`.  
(You can set it to whatever you want but just be sure to update the php docker config and rebuild the box) 
```
> sudo ifconfig lo0 alias 10.254.254.254
```

You can verify this alias IP is attached to your `lo0` device by inspecting the output when running `ifconfig` on your host machine:
```
> ifconfig
```

Enable xdebug on the php docker box:
```
(from outside the container)
> docker exec -it ddd-code-sample-php74 ./toggle-xdebug
PHP Xdebug Enabled & OPcache Disabled!

(from inside the container)
> /var/www/app/toggle-xdebug
PHP Xdebug Disabled & OPcache Enabled!
```
