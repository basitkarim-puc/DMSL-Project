<?php
    include_once('libs/connection.php');
    if(isset($_REQUEST['course_delete'])){
        $id = $_REQUEST['course_delete'];
        $query = "DELETE FROM `enrolled_course` WHERE id = '".$id."'";
        if(mysqli_query($conn,$query)){
            header("location: index.php");
        }
    }

?>