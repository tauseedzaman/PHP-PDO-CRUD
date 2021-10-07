<?php $conn = new PDO("mysql:host=localhost; dbname=pdo_created_db","root","");?>

<?php

$name = $_POST['name'];
    $email = $_POST['email'];
    try {
        $query = "INSERT INTO users(name,email)VALUES('".$name."','".$email."')";
        $conn->exec($query) or die("Something went wrong!");
        return header('location: index.php');
    }
    catch (PDOException $exception){
        die('error: '.$exception->getMessage());
    }