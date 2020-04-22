<?php
require_once "database/connection.php";
require_once "database/models/article.php";

function viewArticlesController(){
    $pdo = connectDB();
    $allnews = getAllArticles($pdo);
    require "views/articles.view.php";    
}

function addArticleController(){
    if(isset($_POST['newstitle'], $_POST['newstext'], $_POST['newstime'], $_POST['removedate'])){
        $title = $_POST['newstitle'];
        $text = $_POST['newstext'];
        $time = $_POST['newstime'];
        $removetime = $_POST['removedate'];
        $pdo = connectDB();
        $userid = $_SESSION["userid"];
        addArticle($pdo, [$title, $text, $time, $removetime, $userid]); 
        header("Location: /");    
    } else {
        require "views/newArticle.view.php";
    }
}

function editArticleController($id){
    $pdo = connectDB();
    try {
        $news = getArticleById($pdo, $id);
    } catch (PDOException $e){
        echo "Virhe uutista haettaessa: " . $e->getMessage();
    }
    
    if($news){
        $id = $news['articleid'];
        $title = $news['title'];
        $text = $news['text'];
        $dbtime = $news['created'];
        $time = implode("T", explode(" ",$dbtime));
        $removetime = $news['expirydate'];
    
        require "views/updateArticle.view.php";
    } else {
      header("location: /uutiset");
      exit;
    }
}

function updateArticleController($id){
    if(isset($_POST['newstitle'], $_POST['newstext'], $_POST['newstime'], $_POST['removedate'], $id)){
        $title = $_POST['newstitle'];
        $text = $_POST['newstext'];
        $time = $_POST['newstime'];
        $removetime = $_POST['removedate'];
        
        $pdo = connectDB();

        try{
            updateArticle($pdo, [$title, $text, $time, $removetime, $id]);
            header("Location: /");    
        } catch (PDOException $e){
                echo "Virhe uutista päivitettäessä: " . $e->getMessage();
        }
    } else {
        header("location: /uutiset");
        exit;
    }
}

function deleteArticleController($id){
    try {
        $pdo = connectDB();
        deleteArticle($pdo, $id);
    } catch (PDOException $e){
        echo "Virhe uutista poistettaessa: " . $e->getMessage();
    }

    $allnews = getAllArticles($pdo);

    header("location: /uutiset");
    exit;
}





