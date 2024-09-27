<?php
session_start();
error_reporting(0);
include('database.php');

$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];

if ($my_idd < 0) {
  header('Location: index.php');
}elseif ($my_idd == '') {
  header('Location: index.php');
}

if ($my_roll != 'admin') {
    echo ("<script LANGUAGE='JavaScript'>
window.alert('You Not Access this page');
window.location.href='dashboard.php';
</script>");
}

$stu_name = $_POST['st_name'];
$stu_mobile = $_POST['st_mobile'];
$stu_email = $_POST['st_email'];
$stu_class = $_POST['st_class'];
$stu_roll = $_POST['st_roll'];


if (isset($_POST['submit'])) {
  // code...

try {
    $sql = "INSERT INTO student 
    ( student_name, student_mobile, student_email, student_class, student_roll_no )  

  VALUES (:value1, :value2, :value3, :value4, :value5)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':value1', $stu_name);
    $stmt->bindParam(':value2', $stu_mobile);
    $stmt->bindParam(':value3', $stu_email);
    $stmt->bindParam(':value4', $stu_class);
    $stmt->bindParam(':value5', $stu_roll);
    
    $stmt->execute();
    header('Location: students.php');
   // echo "Record inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

}

//theme file include Here
include('inc/header.php');
include('inc/sidebar.php');
include('inc/nevbar.php');

?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h1 class="m-0">Add Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="teachers.php" class="btn btn-block btn-warning btn-sm">Back to Student Page</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="card p-4">
       <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add  a new Students</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Name</label>
                    <input name="st_name" type="text" class="form-control" placeholder="Student Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Mobile</label>
                    <input name="st_mobile" type="text" class="form-control" placeholder="Student Mobile">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Email</label>
                    <input name="st_email" type="text" class="form-control" placeholder="Student Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Class</label>
                    <input name="st_class" type="text" class="form-control" placeholder="Student class">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Roll-No</label>
                    <input name="st_roll" type="text" class="form-control" placeholder="Student Roll No">
                  </div>
                                  
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        
          </div>
         </div>   
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
 <?php

include('inc/footer.php');
?> 	