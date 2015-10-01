<?php
//принял аддрес + проверка
$urlStr = addslashes(trim($_POST['url']));
//разбиваем строку
$url = parse_url($urlStr);
$firstPartUrl = $url["host"]; //1 часть url
//забираем последний элемент массива
$secondPartUrl = array_pop($url); //2 часть url

$shortUrl = substr(uniqid(), -6); //3 запись в бд
//var_dump($shortUrl);
//die;

//подключение к бд
//db config

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

$sqlSelectAll = "SELECT * FROM address";
$result = $db->query($sqlSelectAll);
$result->bindColumn('id', $id);
$result->bindColumn('domain', $newFirstUrl);
$result->bindParam('url',$newSecondPartUrl);
$result->bindColumn('short_url', $newShortUrl);
$http = "https://";
while ($result->fetch(PDO::FETCH_ASSOC)) {
    echo " $id. <a href=$http$newFirstUrl$newSecondPartUrl>$newFirstUrl$newShortUrl</a><br>";
}



