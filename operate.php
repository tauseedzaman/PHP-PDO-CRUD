<?php
$conn = new PDO("mysql:host=localhost; dbname=pdo_created_db","root","") or die("errors");

/*
 * insert form data into database table called users
 */
if (isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    try {
        $query = "INSERT INTO users(name,email)VALUES('".$name."','".$email."')";
        $conn->exec($query) or die("Something went wrong!");
        
        session_start();
        $_SESSION['message'] = "<b>Success!</b> New Record Added</p> ";
        
        return header('location: index.php');
    }
    catch (PDOException $exception){
        die('error: '.$exception->getMessage());
    }
}

/*
 * delete data from database table called users by id
 */
if (isset($_POST['delete'])){
    $id = $_POST['delete'];
    try {
    $query = "delete from users WHERE id =".$id;
    echo $query;
    $conn->exec($query) or die("Something went wrong!");
    
    session_start();
    $_SESSION['message'] = "<b>Success!</b> Row Deleted</p> ";
    
    return header('location: index.php');
    }
    catch (PDOException $exception){
        die('error: '.$exception->getMessage());
    }
}

/*
 * Edit database data
 */
if (isset($_POST['edit'])){
    $id = $_POST['edit'];
    try {
        $query = $conn->prepare("select * from users WHERE id =".$id);
        $query->execute() or die("Something went wrong!");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $data = $query->fetchAll();
        echo '<!doctype html><html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport"
                        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>PDO Crud</title>
                    <link rel="stylesheet" href="bootstrap.css">
                </head>
                <body class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10  mx-auto  ">
                            <h5 class="text-center text-info">Edit User</h5>
                            <form action="" method="post" class="form-inline">
                            <input type="hidden" name="update" value="'.$data[0]['id'].'">
                                    <input type="text" value="'.$data[0]['name'].'" name="e_name" placeholder="Enter Name" class=" form-control col ">
                                    <input type="email" value="'.$data[0]['email'].'" name="e_email" placeholder="Enter Email" class="form-control col border-left-0">
                                <button class="btn btn-success btn-block my-3" type="submit">Submit</button>
                            </form></div></div></div></body></html>';
    }
    catch (PDOException $exception){
        die('error: '.$exception->getMessage());
    }
}


/*
 * update data
 */
if (isset($_POST['update'])){
    $id = $_POST['update'];
    $name = $_POST['e_name'];
    $email = $_POST['e_email'];
    try {
        $query = "update users set name='".$name."',email='".$email."' WHERE id =".$id;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        session_start();
        $_SESSION['message'] = "<b>Success!</b> Row Updated!</p> ";
        
        return header('location: ./index.php');
    }
    catch (PDOException $exception){
        die('error: '.$exception->getMessage());
    }
}