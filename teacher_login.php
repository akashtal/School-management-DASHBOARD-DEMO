<?php
session_start();

include('database.php');
include('inc/header.php');

if (isset($_POST['submit'])) {
    $teacher_mobile = $_POST['tcr_mobile'];
    $teacher_pass = $_POST['tcr_password'];

    try {
        // Use prepared statements to prevent SQL injection
        $stmt = $pdo->prepare("SELECT * FROM teachers WHERE teacher_mobile = :mobile AND teacher_pass =
        	    :password");
        $stmt->bindParam(':mobile', $teacher_mobile);
        $stmt->bindParam(':password', $teacher_pass);
        $stmt->execute();

        // Store the result in a variable
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user_id = $result['id'];
            $user_mobile = $result['teacher_mobile'];
            $user_name = $result['teacher_name'];

            $_SESSION['my_id'] = $user_id;
            $_SESSION['my_mobile'] = $user_mobile;
            $_SESSION['my_name'] = $user_name;
            $_SESSION['my_roll'] = 'teacher';
            

            if ($user_id > 0) {
                header("Location: dashboard.php");
              }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<style>
  body {
    background-image: url('assets/img/teacher_bg.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
    background-size: cover; /* This ensures that the background image covers the entire body */
    background-repeat: no-repeat; /* Prevents the background image from repeating */
  }
</style>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>School</b>Dashboard</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login Here</p>

      <form action="" method="post">
       
         <div class="input-group mb-3">
          <input name="tcr_mobile" type="text" class="form-control" placeholder="Mobile Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-solid fa-mobile"></span>
            </div>
          </div>
        </div>
       
        <div class="input-group mb-3">
          <input name="tcr_password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
       
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button name="submit" type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="register.php" class="text-center">I am a New Member</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>


