<?php
//принял аддрес + проверка
$urlStr = addslashes(trim($_POST['url']));
//разбиваем строку
$url = parse_url($urlStr);
$firstPartUrl = $url["host"]; //1 часть url
//забираем последний элемент массива
$secondPartUrl = array_pop($url); //2 часть url

//создание короткой ссылки
function generateLink($length = 4)
{
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $shortUrl = '';
    for ($i = 0; $i < $length; $i++) {
        $shortUrl .= substr($chars, rand(0, strlen($chars) - 1), 1);
    }

    return $shortUrl;
}

$shortUrl = generateLink(); //3 запись в бд

//подключение к бд
//db config
$host = 'localhost';
$database = 'short_link';
$login = 'root';
$password = '';

//try {
//    $db = new PDO('mysql:host=' . $host . ';db=' . $database, $login, $password);
//} catch (PDOException $e) {
//    echo $e->getMessage();
//}
$db = new PDO('mysql:host=localhost;dbname=short_link', 'root', '');
$sql = "INSERT INTO address (domain, url, short_url) VALUES (:firstPart, :secondPart. :short)";
$stmt = $db->prepare($sql);

$stmt->bindValue(':firstPart', $firstPartUrl);
$stmt->bindValue(':secondPart', $secondPartUrl);
$stmt->bindValue(':short', $shortUrl);
$stmt->execute();


var_dump($sql);
//"INSERT INTO" . " $table "."(domain, url, short_url) VALUES ('" .$firstPartUrl."', '" .$secondPartUrl. "', '" .$shortUrl."')";
//$result = $db->exec($stmt);

