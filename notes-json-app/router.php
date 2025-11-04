<?php
// router.php — для запуска: php -S localhost:8000 router.php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Если файл существует (статический), отдать его напрямую:
$requested = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($requested)) {
    return false; // let the built-in server serve the file
}

// Иначе отдать наш фронт-контроллер
require_once __DIR__ . '/public/index.php';
