<?php
error_reporting(0);
include('database.php');
include('inc/header.php');

$student_names = $_POST['st_name'];
$student_mobiles = $_POST['st_mobile'];
$student_classs = $_POST['st_class'];
$student_passs = $_POST['st_password'];
$student_emails = $_POST['st_email'];
$student_photos = $_POST['st_photo'];



//$encrypted_password = md5($student_passs);

if (isset($_POST['submit'])) {
  // code...

try {
    $sql = "INSERT INTO student 
    (student_name, 
     student_mobile,
     student_class,
     student_pass, 
     student_email,
     student_photo )  

  VALUES (:value1, :value2, :value3, :value4, :value5, :value6 )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':value1', $student_names);
    $stmt->bindParam(':value2', $student_mobiles);
    $stmt->bindParam(':value3', $student_classs);
    $stmt->bindParam(':value4', $student_passs);
    $stmt->bindParam(':value5', $student_emails);
    $stmt->bindParam(':value6', $student_photos);

    $stmt->execute();



    header('Location: index.php');
   // echo "Record inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

}

?>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>School</b>Dashboard</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input name="st_name" type="text" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
         <div class="input-group mb-3">
          <input name="st_mobile" type="text" class="form-control" placeholder="Mobile Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-solid fa-mobile"></span>
            </div>
          </div>
        </div>  

        <div class="input-group mb-3">   
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
        <div class="input-group mb-3">
          <input name="st_email" type="text" class="form-control" placeholder="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-solid fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="st_password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
         <div class="mb-3">
           <label for="formFileMultiple" class="form-label">Add Photo</label>
           <input name="st_photo" class="form-control" type="file" id="formFileMultiple" multiple>
         </div>

        <div class="row">      
          <!-- /.col -->
          <div class="col-4">
            <button name="submit" type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

