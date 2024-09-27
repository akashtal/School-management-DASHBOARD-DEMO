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

$session_year = $_POST['Add_session'];

if (isset($_POST['submit'])) {
  // code...

try {
    $sql = "INSERT INTO session 
    (session_name )  

  VALUES (:value1)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':value1', $session_year);
   
    $stmt->execute();
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
           <h1 class="m-0">Add New Session</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="class.php" class="btn btn-block btn-warning btn-sm">Back to Session Page</a></li>

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
                <h3 class="card-title">ADD SESSION</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Session Year</label>
                    <input name="Add_session" type="text" class="form-control" placeholder="Eg.Year 2023,2024,2025">
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