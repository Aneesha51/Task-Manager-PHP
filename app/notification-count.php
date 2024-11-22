<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "../server/DatabaseConnection.php";
    include "../app/Notification.php";

    $count_notification = count_notification($conn, $_SESSION['id']);
    if ($count_notification) {
        echo "&nbsp;". $count_notification. "&nbsp;";
    }
 }else{ 
  echo "";
}
 ?>