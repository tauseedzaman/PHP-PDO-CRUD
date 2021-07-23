<?php $conn = new PDO("mysql:host=localhost; dbname=pdo_created_db","root","");?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO Crud</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body class="bg-light">
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto rounded-top">
            <h1 class="text-center py-3 text-info bg-warning rounded shadow">PDO CRUD</h1>
        </div>
        <div class="col-md-10  mx-auto  ">
            <h5 class="text-center text-info">Create New User</h5>
            <form action="operate.php" method="post" class="form-inline">
                    <input type="text" name="name" placeholder="Enter Name" class=" form-control col ">
                    <input type="email" name="email" placeholder="Enter Email" class="form-control col border-left-0">
                <button class="btn btn-success btn-block my-3">Submit</button>
            </form>
        </div>
        <div class="col-md-10 mx-auto rounded">
            <table class="table table-hover table-info table-bordered shadow">
                <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th  class="text-center">Email</th>
                    <th  class="text-center">Created_at</th>
                    <th  class="text-center">Actions</th>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        try {
                            $query = $conn->prepare("SELECT * FROM users");
                            $query->execute();
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $data = $query->fetchAll();
                            foreach ($data as $row){
                                echo ' <td  class="text-center">'.$row['id'].'</td>
                        <td  class="text-left">'.$row['name'].'</td>
                        <td  class="text-left">'.$row['email'].'</td>
                        <td  class="text-left">'.date("m/ d/ y",strtotime($row['created_at'])).'<td>
                        <td  class="text-center form-inline">
                            <form action="operate.php" method="post" class="">
                            <input type="hidden" name="edit"  value="'.$row['id'].'">
                            <button class="btn btn-sm btn-primary">Edit</button></form>
                            <form action="operate.php" method="post" class="">
                            <input type="hidden" name="delete"  value="'.$row['id'].'">
                            <button class="btn btn-sm btn-danger" type="submit" >Delete</button></form></td></tr>';
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