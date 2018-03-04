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
    }

    

    $qry = 'select * from student';
    $result = mysqli_query($conn, $qry);

?>

<html>
<head>
<title>
Lab Exam | Home
</title>
</head>
<body>
    <h1>Student Details</h1>
    <form action='#' method='post' style='text-align:center;'>
        <?php 
            if(isset($_GET['updateid']))
            {
                $name = $_GET['name'];
                $course = $_GET['course'];
                $id = $_GET['updateid'];

                echo "<input type='text' name='id' value='$id' hidden>
                Name
                <input type='text' name='name' value='$name'>
                Course
                <input type='text' name='course' value='$course'>
                <input type='submit' name='update' value='Update'>";
            }
            else{
                echo "Name
                <input type='text' name='name'>
                Course
                <input type='text' name='course'>
                <input type='submit' name='add' value='add'>";
            }
        ?>
        <div>
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