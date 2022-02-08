<?php
include("auth_session.php");
require_once ("../libs/connection.php");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <style>

  .card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;
}
.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
}
.card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}
.card-box p {
    font-size: 18px;
}
.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 72px;
    color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}
.bg-blue {
    background-color: #00c0ef !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-red {
    background-color: #d9534f !important;
}
img.center {
    display: block;
    margin: 0 auto;
}


div.demo-content{box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.20);color:#8d9090;}
#notification-header {
	padding: 10px;
	text-align:right;
}
button#notification-icon {
	background: transparent;
	border: 0;
	position:relative;
	cursor:pointer;
}
#notification-count{
	position: absolute;
	left: 0px;
	top: 0px;
	font-size: 0.8em;		
	color: #de5050;
	font-weight:bold;
}
#form-header {
	font-size:1.5em;
}
#frmNotification {
	padding:20px 30px;
}
.form-row{
	padding-bottom:20px;
}
#btn-send {
	background: #258bdc;
	color: #FFF;
	padding: 10px 40px;
	border: 0px;
}
div.demo-content input[type='text'],textarea{
	width: 100%;
	padding: 10px 5px;
}
#notification-latest {
	color: white;
	position: fixed;
	z-index: 99;
	right: 0px;
	background: #17eccf;
	box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.20);		
	max-width: 250px;
	text-align: left;
}
.notification-item {
	padding:10px;
	border-bottom: #3ae2cb 1px solid;
	cursor:pointer;
}
.notification-subject {		
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.notification-comment {		
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-style:italic;
}
  </style>
</head>

<body style="font-family: 'SolaimanLipi', Arial, sans-serif !important;" >

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <?php include("sidebar.php");?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav  class="navbar navbar-expand-lg navbar-light bg-light border-bottom" >
        <button class="btn btn-primary" id="menu-toggle">Menu</button>
		
    
       
      </nav>

      <div class="container-fluid">
	  <div class="container">
       <div class="row">
			<div class="col-lg-3 col-sm-6">
                <?php
                    $query = "SELECT count(*) as total_student FROM `student_info`";
                    $result = mysqli_query($conn,$query);
                    $arr = mysqli_fetch_array($result);
                ?>

                <div class="card-box bg-green">
                    <div class="inner">
                        <h3> <?php echo $arr['total_student']; ?> </h3>
                        <p> Total Student</p>
                    </div>
                  
                </div>
            </div>
			 <div class="col-lg-3 col-sm-6">
                <?php
                    $query = "SELECT *  FROM `enrolled_course` GROUP BY student_id;";
                    $result = mysqli_query($conn,$query);
                    $total_enrolled = 0;
                    while($arr = mysqli_fetch_array($result)){
                        $total_enrolled++;
                    }

                ?>
                <div class="card-box bg-orange">
                    <div class="inner">
                        <h3> <?php echo $total_enrolled; ?> </h3>
                        <p> Total Enrolled Student</p>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <?php
                    $query = "SELECT count(*) as total_course FROM `course`";
                    $result = mysqli_query($conn,$query);
                    $arr = mysqli_fetch_array($result);
                ?>
                <div class="card-box bg-blue">
                    <div class="inner">
                        <h3> <?php echo $arr['total_course']; ?> </h3>
                        <p> Total Course</p>
                    </div>
                </div>
            </div>
        </div>
		
      </div>
    </div>
	</div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
