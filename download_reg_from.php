<?php
session_start();
error_reporting(0);
include('database.php');

$my_idd = $_SESSION['my_id'];
$my_name = $_SESSION['my_name'];
$my_roll = $_SESSION['my_roll'];
$my_mobile = $_SESSION['my_mobile'];

try {
    $sql2 = "SELECT * FROM reg_from WHERE reg_st_mobile = :my_mobile AND reg_st_status = 'Pending'";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':my_mobile', $my_mobile, PDO::PARAM_STR);
    $stmt2->execute();

    while ($row2 = $stmt2->fetch()) {
        // Process the retrieved data
        $reg_id = $row2['id'];
        $reg_status = $row2['reg_st_status'];
        $reg_photo = $row2['reg_st_photo'];
        $reg_markshit = $row2['reg_st_markshet_upload'];
        $reg_st_names = $row2['reg_st_name'];
        $reg_st_emails = $row2['reg_st_email'];
        $reg_st_mobiles = $row2['reg_st_mobile'];
        $reg_st_class = $row2['reg_st_class'];

        $reg_st_obtained = $row2['reg_st_prev_marks_obtained'];
        $reg_st_marks = $row2['reg_st_prev_marks_total'];
        $reg_st_percen = $row2['reg_st_percentage'];
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Online Student Registration Form</title>
    <link rel="stylesheet" href="assets/style.css">
    
</head>

<body>
    <style>
      @page { size: auto; margin: 00mm; margin-left: -70px; margin-right: -70px}
      @media print {
        a[href]:after {
            content: none !important;
        }
      }    
      @media print {
        #printbtn {
            display: none !important;
        }
        .main-heading {
            font-size: 30px !important;
        } 
        .underling {
            line-height: 27px !important;
            text-decoration-style: dotted !important;
        }
      }
    </style>

    <div class="container">
        <h1>Guwahati Hs College/School</h1>
        <h2>Gauhati Hs College R. G. Barooah Road Guwahati - 781021, Assam, India</h2>
        <p>Guwahati - 781021, ASSAM (India) Email : gccgolden@gmail.com Phone : 0361-2410064, 0361-2416589</p>
        <hr>
        <div class="form-wrapper">
           <h3>Student Details</h3>
            <div class="form-item">
                <label for="fullname">Student Image:</label>
                <td><img src="uploads-doc/student/pasport/<?php echo $reg_photo; ?>" alt="Student Image" style="max-width: 80px; max-height: 80px;"></td>
           </div>

                <div class="form-item">
                    <label for="fullname">Student Name:</label>
                    <input type="text" placeholder="<?php echo $reg_st_names?>">
                </div>
           <!--     
                <div class="form-item">
                    <label for="username">Father's Name:</label>
                    <input type="text" name="username" id="fathersname" placeholder="Father's Full Name" required>
                </div>
                <div class="form-item">
                    <label for="username">Mother's Name:</label>
                    <input type="text" name="username" id="mothersname" placeholder="Mother's Full Name" required>
                </div>
           --->     

                <div class="form-item">
                    <label for="gender">Gender:</label>
                    <input type="text" placeholder="Male">

                    </div>
                </div>
                <div class="form-item">
                    <label for="email">Date of Birth</label>
                    <input type="email" placeholder="20/11/2023" required>
                </div>
                <div class="form-item">
                    <label for="email">E-mail:</label>
                    <input type="email" placeholder="<?php echo $reg_st_emails ?>">
                </div>

                <div class="form-item">
                    <label for="department">Department:</label>
                    <input type="email" placeholder="English">
                </div>
                <div class="form-item">
                    <label for="department">Admission Status</label>
                    <input type="email" placeholder="<?php echo $reg_status?>">
                </div>

                <div class="form-item">
                    <label for="phonenumber">Tel/Mobile:</label>
                    <input type="tel" placeholder="<?php echo $reg_st_mobiles?>">
                </div>
<!--
                <h3>Permanent Address</h3>
                <div class="form-item">
                    <label for="pstate">State:</label>
                    <input type="text" name="pstate" id="pstate" placeholder="State" required>
                </div>
                <div class="form-item">
                    <label for="pcity">City:</label>
                    <input type="text" name="pcity" id="pcity" placeholder="City" required>
                </div>
                <div class="form-item">
                    <label for="pzip">Zip Code:</label>
                    <input type="number" name="pzip" id="pzip" placeholder="Zip Code" required>
                </div>
--->
                <h3>Marks & Marksheet</h3>

            <div class="form-item">
                <label for="fullname">Marksheet Image:</label>
                <td><img src="uploads-doc/student/markshit/<?php echo $reg_markshit; ?>" alt="Student Image" style="max-width: 80px; max-height: 80px;"></td>
           </div>
                <div class="form-item">
                    <label for="tstate">Marks Obtained</label>
                    <input type="text" placeholder="<?php echo $reg_st_obtained?>">
                </div>
                <div class="form-item">
                    <label for="tcity">Total Marks</label>
                    <input type="text" placeholder="<?php echo $reg_st_marks?>">
                </div>
                <div class="form-item">
                    <label for="tzip">Percentage</label>
                    <input type="number" placeholder="<?php echo $reg_st_percen?>%">
                </div>
             
              <center><button type="button" class="btn btn-primary" id="printbtn" onclick="window.print()">Print Form</button></center>
        </div>

    </div>

</body>

</html>