<?php
require_once('libs/connection.php');
if(isset($_REQUEST['course_id'])) {
    $sem = $_REQUEST['course_id'];
    $sql = "SELECT * FROM `course` WHERE semester ='$sem'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0) {
      echo "<option value=''>Select Course</option>";
      while($row = mysqli_fetch_array($res)) {
        $id = $row['id'];
        echo '<option value="'.$row['id'].'">'.$row['code']." - ".$row['name'].'</option>';
        
      }
    }else{
        echo '<option value="null">No course found!</option>';
      }
  }
?>