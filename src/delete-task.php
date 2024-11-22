<?php 
session_start();

if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "../server/DatabaseConnection.php";
    include "../app/Task.php";
    
    // Check if 'id' is set in the URL, redirect if not
    if (!isset($_GET['id'])) {
        header("Location: ../src/AllTasks.php");
        exit();
    }

    // Retrieve the task ID from the URL
    $id = $_GET['id'];

    // Fetch the task by its ID
    $task = get_task_by_id($conn, $id);

    // If task does not exist, redirect back to tasks
    if ($task == 0) {
        header("Location: ../src/AllTasks.php");
        exit();
    }

    // Prepare the data for deletion and delete the task
    $data = array($id);
    delete_task($conn, $data);

    // Redirect with success message
    $sm = "Deleted Successfully";
    header("Location: ../src/../src/AllTasks.php?success=$sm");
    exit();

} else { 
    // If user is not logged in as admin, redirect to login page
    $em = "First login";
    header("Location: UserLogin.php?error=$em");
    exit();
}
?>
