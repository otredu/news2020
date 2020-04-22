<?php

function getAllArticles($pdo){
    $sql = "SELECT * FROM articles";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

function addArticle($pdo, $data){
    $sql = "INSERT INTO articles (title, text, created, expirydate, userid) VALUES(?,?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function getArticleById($pdo, $id)
{
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

function updateArticle($pdo, $data){
    $sql = "UPDATE articles SET title = ?, text = ?, created = ?, expirydate = ? WHERE articleid = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}