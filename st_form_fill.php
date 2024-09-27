<?php
session_start();
error_reporting(0);
include('database.php');

$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];
$my_mobile = $_SESSION['my_mobile'];

$total_marks = $_GET['st_total'];
$mark_obtained = $_GET['st_obtained'];

$method = 'GET';
if ($total_marks != '' && $mark_obtained != '') {
    $percentage = ($mark_obtained / $total_marks) * 100;
    $method = 'POST';
}

try {
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM student WHERE id = :my_idd";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':my_idd', $my_idd, PDO::PARAM_INT);
    $stmt->execute();

    while($row = $stmt->fetch()){
        $student_id = $row['id'];
        $student_mobile = $row['student_mobile'];
        $student_name = $row['student_name'];
        $student_email = $row['student_email'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($my_idd < 0) {
    // Redirect to index.php if user ID is less than 0 or no record found
    header('Location: index.php');
    exit(); // Add exit to stop further execution
} elseif ($my_idd == '') {
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

if (isset($_POST['procces'])) {
    $value1 = $student_name;
    $value2 = $student_mobile;
    $value3 = $student_email;
    $value4 = $_POST['st_class'];
    $value5 = $_POST['st_total'];
    $value6 = $_POST['st_obtained'];
    $value7 = $percentage;

    try {
        $sql = "INSERT INTO reg_from (reg_st_name, reg_st_mobile, reg_st_email, reg_st_class, reg_st_prev_marks_obtained, reg_st_prev_marks_total, reg_st_percentage) 
                VALUES (:value1, :value2, :value3, :value4, :value5, :value6, :value7)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value1', $value1);
        $stmt->bindParam(':value2', $value2);
        $stmt->bindParam(':value3', $value3);
        $stmt->bindParam(':value4', $value4);
        $stmt->bindParam(':value5', $value5);
        $stmt->bindParam(':value6', $value6);
        $stmt->bindParam(':value7', $value7);

        $stmt->execute();
        $last_id = $pdo->lastInsertId();
        header("Location: st_from_fill2.php?id=$last_id");
       // echo "Record inserted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Theme file includes here
include('inc/header.php');
include('inc/sidebar.php');
include('inc/nevbar.php');

//now we will check if the student has already filled up the from. If yes then we willl redirect him to admission status page//

try {
    $sql2 = "SELECT * FROM reg_from WHERE reg_st_mobile = '$my_mobile' AND reg_st_status = 'Pending'";
    $stmt2 = $pdo->query($sql2);
    $stmt2->execute();

    while ($row2 = $stmt2->fetch()) {
        // Process the retrieved data
     $reg_id = $row2['id'];

     if ($reg_id > 0) {
        echo ("<script LANGUAGE='JavaScript'>
                      window.alert('You cannot access this page');
                      window.location.href='admission.php';
               </script>"); 
     }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
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
                                <form method="<?php echo $method?>" action="">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <i class="fas fa-check"></i>
                                                <label>Student Name</label>
                                                <input type="text" name="st_name" readonly class="form-control" placeholder="<?php echo $my_name ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <i class="fas fa-check"></i>
                                                <label>Student Mobile</label>
                                                <input type="text" name="st_mobile" readonly class="form-control" placeholder="<?php echo $student_mobile ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <i class="fas fa-check"></i>
                                                <label>Student Email</label>
                                                <input type="text" name="st_email" readonly class="form-control" placeholder="<?php echo $student_email ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Total Mark</label>
                                                <input onchange="this.form.submit()" type="text" value="<?php echo $total_marks ?>" name="st_total" class="form-control" placeholder="Eg:600">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Total Obtained</label>
                                                <input onchange="this.form.submit()" type="text" value="<?php echo $mark_obtained ?>" name="st_obtained" class="form-control" placeholder="Eg:600">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <i class="fas fa-check"></i>
                                                <label>Percentage</label>
                                                <input type="text" name="st_percen" readonly class="form-control" placeholder="<?php echo $percentage ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Class</label>
                                                <select name="st_class" class="form-control">      
                                                <option value="">------Select Class------</option>
                                            <?php
                                               $stmt = $pdo->prepare("SELECT * FROM class ");
                                               $stmt->execute();

                                               while ($row = $stmt->fetch()) {
                                                      $my_class = $row['class_name'];    
                                            ?> 
                                                <option ><?php echo $my_class ?></option>
                                            <?php 
                                            } 
                                            ?>
                                                </select>
                                        </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item">
                                             <?php
                                             if ($method == 'GET') {
                                                 ?>
                                                 <noscript>
                                                    <button class="btn btn-block btn-warning btn-md" type="submit" value="submit" name="submit">Submit</button>
                                                </noscript>
                                                  <?php
                                             }else {
                                                ?>
                                                <button class="btn btn-block btn-warning btn-md" type="procces" value="procces" name="procces">Submit</button>
                                                <?php
                                             }
                                             ?>   
                                                
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
