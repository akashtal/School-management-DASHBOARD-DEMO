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

// Theme file include here
include('inc/header.php');
include('inc/sidebar.php');
include('inc/nevbar.php');

// Handle search
$search_query = isset($_GET['table_search']) ? $_GET['table_search'] : '';
$search_condition = $search_query ? "WHERE student_name LIKE '%$search_query%'" : '';

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
                            <h1 class="m-0">Students Table</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="add_student.php" class="btn btn-block btn-warning btn-sm">Add Student</a>
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
                        <div class="card-header">
                            <h3 class="card-title">Students</h3>
                            <div class="card-tools">
                                <form method="GET">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="<?php echo $search_query; ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="container-fluid">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Student Name</th>
                                                <th>Student Mobile</th>
                                                <th>Student Email</th>
                                                <th>Student Class</th>
                                                <th>Student Roll-No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $pdo->prepare("SELECT * FROM student $search_condition");
                                            $stmt->execute();

                                            while ($row = $stmt->fetch()) {
                                                $my_name = $row['student_name'];
                                                $my_mobile = $row['student_mobile'];
                                                $my_email = $row['student_email'];
                                                $my_class = $row['student_class'];
                                                $my_rollno = $row['student_roll_no'];
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$i ?>.</td>
                                                    <td><?php echo $my_name ?></td>
                                                    <td><?php echo $my_mobile ?></td>
                                                    <td><?php echo $my_email ?></td>
                                                    <td><?php echo $my_class ?></td>
                                                    <td><?php echo $my_rollno ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="students_edit.php" class="btn btn-primary">Edit</a>
                                                            <a href="students_delete.php" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Add your Bootstrap and other JS scripts here -->
        <script src="path/to/jquery.min.js"></script>
        <script src="path/to/bootstrap.min.js"></script>
        <!-- Add your custom scripts if needed -->
        <script>
            // Add your custom scripts here
        </script>
    </div>

    <?php
    include('inc/footer.php');
    ?>
</body>
