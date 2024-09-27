<?php
session_start();
include('database.php');
$my_roll = $_SESSION['my_roll'];

if ($my_roll != 'admin') {
    echo ("<script LANGUAGE='JavaScript'>
window.alert('You Not Access this page');
window.location.href='dashboard.php';
</script>");
}

try {
    $sql = "DELETE FROM class WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    $id = $_GET['id'];

    $stmt->execute();
    header('Location: class.php');
   // echo "Record deleted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
