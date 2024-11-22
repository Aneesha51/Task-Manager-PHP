<?php 
session_start();

if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "../server/DatabaseConnection.php";
    include "../app/Notification.php";

    // Check if 'id' is set in the URL, redirect if not
    if (!isset($_GET['id'])) {
        header("Location: ../src/admin-notification.php");
        exit();
    }

    // Retrieve the notification ID from the URL
    $id = $_GET['id'];

    // Fetch the notification by its ID
    $notification = get_notifications_by_id($conn, $id);

    // If notification does not exist, redirect back to notifications page
    if (!$notification) {
        header("Location: ../src/admin-notification.php");
        exit();
    }

    // Prepare the data for deletion
    $data = array($id);

    // Attempt to delete the notification
    if (delete_notifications($conn, $data)) {
        // Redirect with success message if deletion is successful
        $sm = "Notification Deleted Successfully";
        header("Location: ../src/admin-notification.php?success=$sm");
        exit();
    } else {
        // Redirect with error message if deletion fails
        $em = "Failed to Delete Notification";
        header("Location: ../src/admin-notification.php?error=$em");
        exit();
    }

} else { 
    // If user is not logged in as admin, redirect to login page
    $em = "Please login first";
    header("Location: UserLogin.php?error=$em");
    exit();
}
?>
