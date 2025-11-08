<?php
require __DIR__ . '/vendor/autoload.php';
var_dump(class_exists('Symfony\\Component\\HttpFoundation\\Request'));
var_dump(defined('Symfony\\Component\\HttpFoundation\\Request::HEADER_X_FORWARDED_ALL'));
echo (new ReflectionClass('Symfony\\Component\\HttpFoundation\\Request'))->getFileName() . PHP_EOL;
