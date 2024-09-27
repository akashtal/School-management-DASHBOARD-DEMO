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

$class_name = $_POST['tch_name'];
$class_mobile = $_POST['tch_mobile'];
$class_email = $_POST['tch_email'];
$class_dept = $_POST['tch_depert'];
$class_class = $_POST['tch_class'];
$class_status = $_POST['tch_status'];

if (isset($_POST['submit'])) {
  // code...

try {
    $sql = "INSERT INTO teachers 
    (teacher_name, teacher_mobile, teacher_email, teacher_dept, teacher_class, teacher_status)  

  VALUES (:value1, :value2, :value3, :value4, :value5, :value6)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':value1', $class_name);
    $stmt->bindParam(':value2', $class_mobile);
    $stmt->bindParam(':value3', $class_email);
    $stmt->bindParam(':value4', $class_dept);
    $stmt->bindParam(':value5', $class_class);
    $stmt->bindParam(':value6', $class_status);
   
    $stmt->execute();
    header('Location: teachers.php');
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
           <h1 class="m-0">Add Class</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="teachers.php" class="btn btn-block btn-warning btn-sm">Back to Teachers Page</a></li>

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
                <h3 class="card-title">Add  a new Teachers</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teacher Name</label>
                    <input name="tch_name" type="text" class="form-control" placeholder="Teacher Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teacher Mobile</label>
                    <input name="tch_mobile" type="text" class="form-control" placeholder="Teacher Mobile">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teacher Email</label>
                    <input name="tch_email" type="text" class="form-control" placeholder="Teacher Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teacher Department</label>
                    <input name="tch_depert" type="text" class="form-control" placeholder="Teacher Department">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teacher Class</label>
                    <input name="tch_class" type="text" class="form-control" placeholder="Teacher Class">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teacher Status</label>
                    <input name="tch_status" type="text" class="form-control" placeholder="Teacher Status">
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