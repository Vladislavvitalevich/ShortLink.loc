<?php
//принял аддрес + проверка
$urlStr = addslashes(trim($_POST['url']));
//разбиваем строку
$url = parse_url($urlStr);
$firstPartUrl = $url["host"]; //1 часть url
//забираем последний элемент массива
$secondPartUrl = array_pop($url); //2 часть url


$shortUrl = substr(uniqid(), -6); //3 запись в бд
var_dump($shortUrl);
die;

//подключение к бд
//db config
$host = 'localhost';
$database = 'short_link';
$login = 'root';
$password = '';

$db = new PDO('mysql:host=localhost;dbname=short_link', 'root', '');
$sql = "INSERT INTO address (domain, url, short_url) VALUES (:firstPart, :secondPart, :short)";
$stmt = $db->prepare($sql);

$stmt->execute(
    array(
        ':firstPart' => $firstPartUrl,
        ':secondPart' => $secondPartUrl,
        ':short' => $shortUrl
    )
);


