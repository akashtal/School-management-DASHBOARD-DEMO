<?php
session_start();
error_reporting(0);
include('database.php');

$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];

if ($my_idd < 0) {
    header('Location: index.php');
} elseif ($my_idd == '') {
    header('Location: index.php');
}


if ($my_roll != 'admin') {
    echo ("<script LANGUAGE='JavaScript'>
window.alert('You Not Access this page');
window.location.href='dashboard.php';
</script>");
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
                            <h1 class="m-0">Class</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="add_class.php" class="btn btn-block btn-warning btn-sm">Add Class</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ALL CLASS</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Class Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $stmt = $pdo->prepare("SELECT * FROM class ");
                                        $stmt->execute();

                                        while ($row = $stmt->fetch()) {
                                            $my_class = $row['class_name'];
                                            $my_id = $row['id'];
                                   // $i = 0;        
                                        ?>

                                            <tr>
                                                <td><?php echo ++$i ?>.</td>
                                                <td><?php echo $my_class ?></td>
                                                <td>
                                                    <div class="">
                                                        <div style="width: 55%">
                                                            <a href="class_edit.php?id=<?php echo $my_id?>"class="btn btn-primary">Edit</a> 
                                                            <a onclick="return confirm('Are you sure')" href="class_delete.php?id=<?php echo $my_id?>"class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <?php
        include('inc/footer.php');
        ?>
