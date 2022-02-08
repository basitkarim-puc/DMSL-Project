<?php
    include_once('libs/sessions.php');
    include_once('libs/connection.php');
    $student_id = $_SESSION['std_id'];
    $email = $_SESSION["email"];
    if(isset($_REQUEST['add_course'])){
        $id = $_REQUEST['course_name'];

        $query = "SELECT id FROM `student_info` WHERE email = '$email'";
        $result = mysqli_query($conn,$query);
        $student_id = $_SESSION['std_id'];
        
        $check = "SELECT * FROM `enrolled_course` WHERE course_id = '$id' AND student_id = '$student_id'";
        $store = mysqli_query($conn,$check);
        if(mysqli_num_rows($store)>0){
          echo "Already enrolled!"; 
        }else{
          $query = "INSERT INTO `enrolled_course`(`course_id`,`student_id`) VALUES ('$id','$student_id')";
          if(mysqli_query($conn,$query)){
              echo "Inserted";
          }else{
              echo "Nope";
          }
        }
      
        
    }

    if(isset($_REQUEST['add_change_pw'])){
      $current = md5($_REQUEST['current_password']);
      $new = $_REQUEST['new_password'];
      $confirm = $_REQUEST['con_password'];
      if($new==$confirm){
        $db_password = "";
        $email  = $_SESSION['email'];
        $query = "SELECT * FROM `student_info` WHERE email = '".$email."'";
        $result = mysqli_query($conn,$query);
        $fetch = mysqli_fetch_array($result);
        $db_password = $fetch['password'];
        if($db_password==$current){
           $confirm = md5($confirm);
            $query = "UPDATE `student_info` SET `password`='$confirm' WHERE email = '".$email."'";
            mysqli_query($conn, $query);
        }else{
          echo "Current Password does not match!";
        }   
      }else{
        echo "New Password And Confirm Password does not match!";
      }
      
      
    }
    

?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style>
    #t_tile{
        text-align: center;
    }
</style>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand text-light" href="index.php" ><img src="logo.png" height="40px" width="40px"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#demo-navbar" aria-controls="demo-navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="demo-navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" data-toggle="modal" data-target="#exampleModalCenter">Add Course</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" data-toggle="modal" data-target="#example_profile">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="result.php">Result</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" data-toggle="modal" data-target="#example_change_pw" >Change Password</a>
      </li>
    
    </ul>
    <a href="logout.php"><button class="btn btn-primary my-2 my-sm-0" type="submit">Logout</button></a>
  </div>
</nav>
</div>
<br>
<div class="container">
    <h3 id = "t_tile">Enrolled Course List</h3>
<table id="t_table" class="table" >
            <thead class="thead-dark">
                <tr>
                <th scope="col">Course Name</th>
                <th scope="col">Course Code</th>
                <th scope="col">Semester</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $retrive = "SELECT  enrolled_course.id as row_id, enrolled_course.course_id as c_id, enrolled_course.status as status, course.name as name, course.code as code, course.semester as sem FROM 
                        enrolled_course JOIN course on enrolled_course.course_id = course.id Where enrolled_course.student_id = '$student_id'";
                        $result = mysqli_query($conn,$retrive);
                        while($row = mysqli_fetch_array($result)){
                            $id = $row['row_id'];

                            ?>
                        <tr>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['code']?></td>
                            <td><?php echo $row['sem']?></td>
                            <?php
                            if($row['status']==0){
                              echo '<td><button class="btn btn-secondary"><a style="color:white; text-decoration:none;" href="delete_c.php?course_delete='.$id.'">Remove</a></button></td>';
                            }else{
                              echo '<td><button class="btn btn-primary"><a style="color:white; text-decoration:none;">Approved</a></button></td>';
                            }
                            ?>
                            
                            </tr>
                    <?php
                    }
                    ?>
                
            </tbody>
            
        </table>

</div>




<!-- Modal for add course -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <div class="modal-body">
            <div class="form-row">
                <div class="col">
                    <label>Select Semester</label>
                        <select name="semester" id = "semester" class="form-control chosen-select">
                            <option value="">Please select semester</option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                            <option value="5">5th</option>
                            <option value="6">6th</option>
                            <option value="7">7th</option>
                            <option value="8">8th</option>
                        </select>
                </div>
		  </div>
          <div class="form-row">
                <div class="col">
                    <label>Select Course</label>
                        <select name="course_name" id = "course_name" class="form-control chosen-select" required>
                            <option value="">Select Course</option>
                        </select>
                </div>
		  </div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_course" class="btn btn-primary">Add</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!--modal for profile-->
<div class="modal fade" id="example_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Profile Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
        $student_id = "";
        $student_name = "";
        $student_email = "";
        $target  =$_SESSION['email'];
        if(strlen($target)!=0){
            $query = "SELECT name, student_id, email FROM `student_info` WHERE email = '$target'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)==1){
              $fetch = mysqli_fetch_array($result);
              $student_id = $fetch['student_id'];
              $student_name = $fetch['name'];
              $student_email = $target;
            }
        }

      ?>
      <div class="modal-body">
          <h5>Name : <?php echo $student_name; ?></h5><br>
          <h6>Student ID : <?php echo $student_id; ?></h6><br>
          <h6>Student Email : <?php echo $student_email; ?></h6><br>
      </div>
      
    </div>
  </div>
</div>

<!--modal for password-->
<div class="modal fade"  id="example_change_pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      <form method="POST">
        <div class="modal-body">
          <div class="form-row">
                  <div class="col">
                      <label>Current Password</label>
                      <input type="password" name="current_password" class="form-control chosen-select" placeholder="Enter your current password" required>
                  </div>
            </div>
          <div class="form-row">
                  <div class="col">
                      <label>New Password</label>
                      <input type="password" name="new_password"  class="form-control chosen-select" placeholder="Enter new password" required>
                  </div>
		      </div>
          <div class="form-row">
                  <div class="col">
                      <label>Confirm Password</label>
                      <input type="password" name="con_password"  class="form-control chosen-select" placeholder="Enter confirm new  password" required>
                  </div>
		      </div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_change_pw" class="btn btn-primary">Save Changes</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script>

$(document).ready(function() {
    $("#semester").change(function() {
        var semester_id = $(this).val();
        if(semester_id != "") {
        $.ajax({
            url:"fetch_course.php",
            data:{course_id:semester_id},
            type:'POST',
            success:function(response) {
            var resp = $.trim(response);
                $("#course_name").html(resp);
            }
        });
        } else {
        $("#course_name").html("<option value=''>------- Select --------</option>");
        }
    });
    });
</script>
</body>
</html>

