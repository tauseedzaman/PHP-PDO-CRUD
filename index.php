<?php $conn = new PDO("mysql:host=localhost; dbname=pdo_created_db","root","");?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO Crud</title>
    <link rel="stylesheet" type="text/css" href="./bootstrap.css">

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto bg-warning shadow rounded-top">
                <h1 class="text-center py-3 text-info  rounded ">PDO CRUD</h1>
            </div>
            <div class="col-md-10  mx-auto  shadow">
                <h5 class="text-center text-info">Add New Record</h5>
                <form class="form-inline" action="operate.php" method="post">
                    <input type="text" required name="name" placeholder="Enter Name" class=" form-control col ">
                    <input type="email" required name="email" placeholder="Enter Email" class="form-control col border-left-0">
                    <button type="submit" id="submit_btn" class="btn btn-success btn-block my-3">Add Record</button>
                </form>
            </div>
            <div class="mt-3 col-md-10 mx-auto shadow rounded">
            <?php
                session_start();
                if(isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                    echo '<p class="alert alert-info">'.$message.'</p>';
                }
                ?>
                
                <table class="table table-hover table-info table-bordered shadow">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Created_at</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        
                            <?php
                        try {
                            $query = $conn->prepare("SELECT * FROM users");
                            $query->execute();
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $data = $query->fetchAll();
                            foreach ($data as $row){
                                echo '<tr data-id="'.$row['id'].'">
                                            <td  class="text-center">'.$row['id'].'</td>
                                            <td  class="text-left">'.$row['name'].'</td>
                                            <td  class="text-left">'.$row['email'].'</td>
                                            <td  class="text-left">'.date("m/ d/ Y",strtotime($row['created_at'])).'</td>
                                            <td  class="text-center form-inline">
                                            <form action="operate.php" method="post" class="">
                                                <input type="hidden" name="edit"  value="'.$row['id'].'">
                                                <button id="edit_btn" class="btn btn-sm btn-primary">Edit</button>
                                            </form>
                                            <form action="operate.php" method="post" class="">
                                                <input type="hidden" name="delete"  value="'.$row['id'].'">
                                                <button id="delete_btn" class="btn btn-sm btn-danger" type="submit" >Delete</button>
                                            </form></td>
                                        </tr>';
                            }
                                
                        }
                        catch (PDOException $e){
                            echo "<br />".$e->getMessage();
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>