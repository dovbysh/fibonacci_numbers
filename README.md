
```
composer install
docker build -t dovbysh/fibonacci .
docker run -it --rm --name fibonacci -v "$PWD":/var/www/html -p 8085:80  dovbysh/fibonacci
```
http://127.0.0.1:8085/web.php?n=300