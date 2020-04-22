<?php
require "database.php";

$pdo = connectDB();

function cleanUp($userinput){
    $input = trim($userinput);
    $cleaninput = htmlspecialchars($input);
    return $cleaninput;
}

$title = "Testataan Leenan koodia";
$text = "Kokeillan juttuja";
$writer = "Tiina Partanen";
$time = "2019-08-03";
$removetime = "2019-09-03";

$cleantitle = cleanUp($title);
$cleantext = cleanUp($text);
$cleanwriter = cleanUp($writer);
$cleantime = cleanUp($time);
$cleanremovetime = cleanUp($removetime);

$sql = "INSERT INTO uutinen (otsikko, sisalto, kirjoituspvm, poistamispvm, kirjoittaja) VALUES (?, ?, ?, ?, ?)";

$statement = $pdo->prepare($sql);
$statement->execute([$cleantitle, $cleantext, $cleantime, $cleanremovetime, $cleanwriter]);

if($statement != FALSE) {
    echo "Onnistui";
} else {
    echo "Pieleen meni";
}
