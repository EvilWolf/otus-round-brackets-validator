## Установка
Поскольку пакет не опубликован на packagist.org, необходимо прописать репозиторий в `composer.json`
  
Создаём или редактируем файл composer.json :    
```
{
  "repositories": [
     {
       "type": "vcs",
       "url": "https://github.com/EvilWolf/otus-round-brackets-validator"
     }
  ],
}
```

Подключаем командой:  
`$ composer require EvilWolf/otus-round-brackets-validator`

## Использование
Создаём файл index.php с содержимым
```php
<?php
require_once('vendor/autoload.php');

use EvilWolf\RoundBracketsValidator;

$header = 'HTTP/1.1 400 Bad Request';

if (!empty($_POST['string'])) {
    $validator = new RoundBracketsValidator($_POST['string']);

    if ($validator->isValid()) {
        $header = 'HTTP/1.1 200 OK';
    }
}

header($header);
```

Проверяем:
```
$ curl -d "string=()()" -H "Content-Type: application/x-www-form-urlencoded" http://localhost/ -i
```

Ответ должен быть:
```
HTTP/1.1 200 OK
Server: nginx/1.17.3
Date: Thu, 26 Sep 2019 16:43:43 GMT
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.3.9
```

В случае невалидных скобок ответ будет:
```
$ curl -d "string=()(()" -H "Content-Type: application/x-www-form-urlencoded" http://localhost/ -i
HTTP/1.1 400 Bad Request
Server: nginx/1.17.3
Date: Thu, 26 Sep 2019 16:44:39 GMT
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.3.9
```
