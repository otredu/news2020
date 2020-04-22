<?php

function addUser($pdo, $data){
    $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES(?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return ($stm->execute($data));
}

function login($pdo, $username, $password){
    $sql = "SELECT * FROM users WHERE username=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$username]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    $hashedpswd = $user["password"];

    if($hashedpswd && password_verify($password, $hashedpswd))
        return $user;
    else 
        return false;
}
