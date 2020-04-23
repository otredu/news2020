<?php

function addUser($pdo, $firstname, $lastname, $username, $password){
    $cleanfirstname = cleanUpInput($firstname);
    $cleanlastname = cleanUpInput($lastname);
    $cleanusername =  cleanUpInput($username);
    $hashedpassword = hashPassword($password);
    $data = [$cleanfirstname, $cleanlastname, $cleanusername, $hashedpassword];
    $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES(?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return ($stm->execute($data));
}

function login($pdo, $username, $password){
    $cleanusername = cleanUpInput($username);
    $sql = "SELECT * FROM users WHERE username=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$cleanusername]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    $hashedpassword = $user["password"];

    if($hashedpassword && password_verify($password, $hashedpassword))
        return $user;
    else 
        return false;
}
