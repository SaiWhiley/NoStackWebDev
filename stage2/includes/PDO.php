<?php 
    $pdo = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n9454829', 'n9454829', 'tunafish;1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $result = $pdo->query('SELECT * FROM parks');
         
    }catch (PDOException $exception){
        echo $e->getMessage();
    }