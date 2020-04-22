<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=news', 'root', '');
    echo "Tietokantayhteys ok";
} catch (PDOException $e){
    echo "Virhe tietokantayhteydessä";
    die();
}

$statement = $pdo->prepare('select * from uutinen');

$statement->execute();

$allnews = $statement->fetchAll();

// echo "<pre>";
// //var_dump($allnews);
// echo "<p>", "Ekan uutisen otsikko on: ", ($allnews[0])["otsikko"],"</p>";
// echo "<p>","Ekan uutisen otsikko on: ", ($allnews[0])["1"],"<p>";
// echo "</pre>";

$statement = $pdo->prepare('select * from uutinen where uutinenID=4');
$statement->execute();
$result1 = $statement->fetchAll();

$insert_test = "INSERT INTO uutinen (uutinenID, otsikko, sisalto, kirjoituspvm, poistamispvm, kirjoittaja) VALUES
(null, 'PHP testi TOIMII!', 'Tänään Tiina sai tehtyä uuden uutisen PHP:stä...', '2019-08-30', '2019-09-05', 'Tiina Partanen')";

// $statement = $pdo->prepare($insert_test);
// $statement->execute();
// $result2 = $statement->fetchAll();

$delete_test = "DELETE FROM uutinen WHERE uutinenID=1";
$statement = $pdo->prepare($delete_test);
$statement->execute();
$result3 = $statement->fetchAll();

echo "<pre>";
var_dump($result1);
//var_dump($result2);
var_dump($result3);
echo "</pre>";

