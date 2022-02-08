<?php
include("auth_session.php");
    require_once ("../libs/connection.php");
    if(isset($_REQUEST['course_id'])){
        $student_id = $_REQUEST['student_id'];
        $course_id = $_REQUEST['course_id'];
        $id = $_REQUEST['id'];
        $query = "INSERT INTO `marks_distribution`(`student_id`, `course_id`) VALUES ('$student_id','$course_id')";
        $update = "UPDATE `enrolled_course` SET `status`='1' WHERE id = '$id'";
        if(mysqli_query($conn,$query)){
            $result = mysqli_query($conn,$update);
            if($result){
                header("location: enrolled_student.php");
            }
        }
        
    }
    if(isset($_REQUEST['published'])){
        $course_id = $_REQUEST['published'];
        $update = "UPDATE `marks_distribution` SET `published`='1' WHERE course_id = '$course_id'";
        if(mysqli_query($conn,$update)){
            header("location: sent_result.php");
        }
        
    }
?>