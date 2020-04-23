<?php

function getAllArticles($pdo){
    $sql = "SELECT * FROM articles";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

function addArticle($pdo, $title, $text, $time, $removetime, $userid){
    $cleantitle = cleanUpInput($title); 
    $cleantext = cleanUpInput($text);
    $cleantime = cleanUpInput($time);
    $cleanremovetime = cleanUpInput($removetime);
    $data = [$cleantitle, $cleantext, $cleantime, $cleanremovetime, $userid];
    $sql = "INSERT INTO articles (title, text, created, expirydate, userid) VALUES(?,?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function getArticleById($pdo, $id){
    $sql = "SELECT * FROM articles WHERE articleid=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$id]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

function deleteArticle($pdo, $id){
    $sql = "DELETE FROM articles WHERE articleid=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$id]);
}

function updateArticle($pdo, $title, $text, $time, $removetime, $articleid){
    $cleantitle = cleanUpInput($title); 
    $cleantext = cleanUpInput($text);
    $cleantime = cleanUpInput($time);
    $cleanremovetime = cleanUpInput($removetime);
    $data = [$cleantitle, $cleantext, $time, $removetime, $articleid];
    $sql = "UPDATE articles SET title = ?, text = ?, created = ?, expirydate = ? WHERE articleid = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}