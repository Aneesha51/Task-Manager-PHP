<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "../server/DatabaseConnection.php";
    include "../app/User.php";
    
    if (!isset($_GET['id'])) {
    	 header("Location: ../src/users.php");
    	 exit();
    }
    $id = $_GET['id'];
    $user = get_user_by_id($conn, $id);

    if ($user == 0) {
    	 header("Location: ../src/users.php");
    	 exit();
    }

     $data = array($id, "employee");
     delete_user($conn, $data);
     $sm = "Deleted Successfully";
     header("Location: ../src/users.php?success=$sm");
     exit();

 }else{ 
   $em = "First login";
   header("Location: UserLogin.php?error=$em");
   exit();
}
 ?>