<?php
session_start();
error_reporting(0);
include('database.php');
// Assuming you have already connected to the database and have $conn available
// Make sure to include the correct file and define get_db_connection() function
$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];
$my_mobile = $_SESSION['my_mobile'];

if (empty($my_idd)) {
    // Redirect to index.php if user ID is empty
    header('Location: index.php');
    exit(); // Add exit to stop further execution
}

if ($my_roll != 'student') {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('You cannot access this page');
        window.location.href='dashboard.php';
    </script>");
}

try {
    $sql2 = "SELECT * FROM reg_from WHERE reg_st_mobile = '$my_mobile' AND reg_st_status = 'Pending'";
    $stmt2 = $pdo->query($sql2);
    $stmt2->execute();

    while ($row2 = $stmt2->fetch()) {
        // Process the retrieved data
     $reg_id = $row2['id'];
     $reg_status = $row2['reg_st_status'];

     if ($reg_id > 0) {
         
     }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
// Theme file includes here
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
                            <h1 class="m-0">Check Admission Status</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="" class="btn btn-block btn-warning btn-sm">Update Your Form Here</a>
                                </li>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Admission Status</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                   <div class="col-md-12" style="text-align: center;">
                                <?php
                                  
                                  if ($reg_status == 'Pending') {
                                      ?>
                                      <a href="" class="btn btn-primary">Your Admission Status is Panding</a>
                                      <br>
                                      <br>
                                      <a href="download_reg_from.php" target="_blank">Download Form</a>
                                      <?php
                                  }elseif ($reg_status == 'Approved') {
                                      ?>
                                      <a href="" class="btn btn-success">Your Admission Status Is Approved</a>
                                      <br>
                                      <?php
                                  } else {
                                    ?>
                                    <br>
                                      <a href="" class="btn btn-danger">You Are Not Eligible For Admission</a> 
                                    <?php
                                  }
                                ?>        
                                   </div> 
                                </div>

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
    </div>
</body>
