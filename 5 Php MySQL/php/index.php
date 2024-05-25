<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>learn crud</title>
    <style>
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td{
            border: 1px solid black;
        }
        th, td{
            padding: 10px;
            text-align: left;
        }
        th{
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        .from-control{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Learn CRUD</h1>
    <?php 
        $mysqli = new mysqli("mysql","user","password","db") or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM emp WHERE 1");
        if (!$result) {
            die("Query Failed: " . $mysqli->error);
        }
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>Eemployee ID</th>
                <th>Name</th>
                <th>Salary</th>
                <th colspan="4">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=$result->fetch_assoc()) :?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['salary'] ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
            
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xs-6" id="column">
                <!-- action: when submit form to load this index page -->
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="salary" class="form-control" placeholder="Salary">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="save" value="save" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['save'])){
            $name = $_POST['name'];
            $salary = $_POST['salary'];
            $mysqli->query("INSERT INTO emp (name, salary) VALUES ('$name', '$salary')") or die($mysqli->error);
            // reload the current page
            header("Location: index.php");
        }
        if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            $mysqli->query("DELETE FROM emp WHERE id=$id") or die($mysqli->error);
            // reload the current page
            header("Location: index.php");
        }
    ?>
</body>
</html>