<?php
    require 'db.php';

    if(isset($_POST['add']))
    {
        $name = $_POST['name'];
        $course = $_POST['course'];

        $qry = "INSERT INTO `student`(`name`, `course`) VALUES ('$name', '$course')";
        $res = mysqli_query($conn, $qry);
        if($res)
        {
            echo "<script>alert('Successful');</script>";
        }
        else{
            echo mysqli_error($conn);
        }
        
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $course = $_POST['course'];


        $qry = "UPDATE `student` SET `name`='$name',`course`='$course' WHERE id=$id;";
        $res = mysqli_query($conn, $qry);
        if($res)
        {
            echo "<script>alert('Updated');</script>";
            unset($_GET);
        }
        else{
            echo mysqli_error($conn);
            echo '<br>'.$qry;
        }
    }

    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];

        $qry = "DELETE FROM `student` WHERE id=$id";
        $res = mysqli_query($conn, $qry);
        if($res)
        {
            echo "<script>alert('Removed');</script>";
        }
        else{
            echo mysqli_error($conn);
        }
    }

    

    $qry = 'select * from student';
    $result = mysqli_query($conn, $qry);

?>

<html>
<head>
<title>
Lab Exam | Home
</title>
<link href='style.css' rel='stylesheet'>
</head>
<body>
    <nav>
        <a href='index.php'><h1>Student Details</h1></a>
    </nav>
    
    <form action='#' method='post' style='text-align:center'>
       <div class='right'>
            <?php 
                if(isset($_GET['updateid']))
                {
                    $name = $_GET['name'];
                    $course = $_GET['course'];
                    $id = $_GET['updateid'];

                    echo "<input type='text' name='id' value='$id' hidden>
                    <label for='name'>Name</label>
                    <input type='text' name='name' value='$name' autofocus><br>
                    <label for='Course'>Course</label>
                    <input type='text' name='course' value='$course'><br>
                    <input type='submit' name='update' value='Update'>";
                }
                else{
                    echo "<label for='name'>Name</label>
                    <input type='text' name='name' autofocus><br>
                    <label for='Course'>Course</label>
                    <input type='text' name='course'><br>
                    <input type='submit' name='add' value='add'>";
                }
            ?>
        </div>

        <table>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <?php
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td><a href='index.php?delete=$row[0]'>delete</a>
                        <a href='index.php?updateid=$row[0]&name=$row[1]&course=$row[2]'>update</a></td></tr>";
                    }
                ?>
            </tr>
        </table>
    </form>
</body>
</html>