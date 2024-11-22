<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "../server/DatabaseConnection.php";
    include "../app/Notification.php";

   if (isset($_GET['notification_id'])) {
       $notification_id = $_GET['notification_id'];
       notification_make_read($conn, $_SESSION['id'], $notification_id);
       header("Location: ../notifications.php");
       exit();

     }else {
       header("Location: ../src/index.php");
       exit();
     }
}else{ 
    $em = "First login";
    header("Location: ../src/UserLogin.php?error=$em");
    exit();
}
 ?>