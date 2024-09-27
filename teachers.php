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
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$search_condition = $search_query ? "WHERE teacher_name LIKE '%$search_query%'" : '';

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
                            <h1 class="m-0">Teachers Table</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="add_teachers.php" class="btn btn-block btn-warning btn-sm">Add Teachers</a>
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
                            <!-- Search Form -->
                            <form method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" value="<?php echo $search_query; ?>">
                                    <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>Search</button>
                                </div>
                            </form>

                            <div class="card-header">
                                <h3 class="card-title"> All Teachers</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Teacher Name</th>
                                                <th>Teacher Mobile</th>
                                                <th>Teacher Email</th>
                                                <th>Teacher Department</th>
                                                <th>Teacher Class</th>
                                                <th>Teacher Status</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $stmt = $pdo->prepare("SELECT * FROM teachers $search_condition");
                                            $stmt->execute();

                                            while ($row = $stmt->fetch()) {
                                                $teacher_id = $row['teacher_id'];
                                                $teacher_name = $row['teacher_name'];
                                                $teacher_mobile = $row['teacher_mobile'];
                                                $teacher_email = $row['teacher_email'];
                                                $teacher_dept = $row['teacher_dept'];
                                                $teacher_class = $row['teacher_class'];
                                                $teacher_status = $row['teacher_status'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $teacher_id; ?></td>
                                                    <td><?php echo $teacher_name; ?></td>
                                                    <td><?php echo $teacher_mobile; ?></td>
                                                    <td><?php echo $teacher_email; ?></td>
                                                    <td><?php echo $teacher_dept; ?></td>
                                                    <td><?php echo $teacher_class; ?></td>
                                                    <td><?php echo $teacher_status; ?></td>
                                                    <td>
                                                        <a href="teachers_edit.php?id=<?php echo $teacher_id; ?>" class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <a href="teachers_delete.php?id=<?php echo $teacher_id; ?>" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
</body>

<?php
include('inc/footer.php');
?>
