<?php
session_start();
error_reporting(0);
include('database.php');

$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];

$my_id = $_GET['id'];

if ($my_idd < 0 || $my_idd == '') {
    header('Location: index.php');
}

if ($my_roll != 'admin') {
    echo ("<script LANGUAGE='JavaScript'>
window.alert('You Not Access this page');
window.location.href='dashboard.php';
</script>");
}

$class_no = $_POST['add_class'];
$value = ''; // Initialize $value to avoid undefined variable notice

try {
    $sql = "SELECT * FROM class WHERE id = $my_id";
    $stmt = $pdo->query($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        // Process the retrieved data
        $value = $row['class_name'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if (isset($_POST['submit'])) {
    try {
        $sql = "UPDATE class SET class_name = :value1 WHERE id = :class_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value1', $class_no);
        $stmt->bindParam(':class_id', $my_id);
   
        $stmt->execute();
        header('Location: class.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Theme file include here
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
                            <li class="breadcrumb-item"><a href="class.php" class="btn btn-block btn-warning btn-sm">Back to Class Page</a></li>
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
                                <h3 class="card-title">Add a new class</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Class Name</label>
                                        <input name="add_class" type="text" class="form-control" placeholder="Eg.Class II,IX,X" value="<?php echo $value?>">
                                    </div>
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
</body>
</html>
