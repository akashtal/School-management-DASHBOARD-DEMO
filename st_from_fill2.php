<?php
session_start();
error_reporting(E_ALL);
// Assuming you have already connected to the database and have $conn available
// Make sure to include the correct file and define get_db_connection() function

$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];

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

include ('database.php');
$value1 = 'Pending';
$id = $_GET['id'];

if (isset($_POST['submit'])) {

  $allow = array("jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "png", "PNG", "pdf", "PDF");
  //1st File
  if($_FILES['photo1']['name'] == "") {
    //echo "No Image"
  } else {

    $photo1=basename($_FILES['photo1']['name']);
    $extension = pathinfo($photo1, PATHINFO_EXTENSION);
    if(in_array($extension,$allow)){
      $target_path = "uploads-doc/student/pasport/";
      $photo1 = md5(rand() * time()).'.'.$extension;
      $target_path = $target_path . $photo1;
      move_uploaded_file($_FILES['photo1']['tmp_name'], $target_path);
      $photo_one = ($photo1!='')?" reg_st_photo='$photo1' ". ',':'';
    }
  }

  $allow = array("jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "png", "PNG", "pdf", "PDF");
  //1st File
  if($_FILES['photo2']['name'] == "") {
    //echo "No Image"
  } else {

    $photo2=basename($_FILES['photo2']['name']);
    $extension = pathinfo($photo2, PATHINFO_EXTENSION);
    if(in_array($extension,$allow)){
      $target_path = "uploads-doc/student/markshit/";
      $photo2 = md5(rand() * time()).'.'.$extension;
      $target_path = $target_path . $photo2;
      move_uploaded_file($_FILES['photo2']['tmp_name'], $target_path);
      $photo_tow = ($photo2!='')?" reg_st_markshet_upload='$photo2' ". ',':'';
    }
  }
    try {
        $sql = "UPDATE reg_from SET 
        $photo_one $photo_tow

         reg_st_status = :value1
         WHERE id = :value2
         ";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':value1', $value1);
        $stmt->bindParam(':value2', $id);
        $stmt->execute();
        echo "Record inserted successfully.";

         header("Location: class.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
                            <h1 class="m-0">FORM</h1>
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
                                <h3 class="card-title">General Elements</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <!-- Include your form fields here -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Student Photo</label>
                                                <input type="file" name="photo1" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Student Marksheet</label>
                                                <input type="file" name="photo2" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item">
                                                <!-- Corrected the button name -->
                                                <button class="btn btn-block btn-warning btn-md" type="submit" name="submit">Submit</button>
                                            </li>
                                        </ol>
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
    </div>
</body>
</html>
