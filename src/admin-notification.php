<?php
session_start();

// Check if the user is an admin
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    // Include your database connection and the functions
    include "../server/DatabaseConnection.php";
    include "../app/Notification.php"; 
    include "../app/User.php";

    $users = get_all_users($conn);
    // Get all notifications
    $notifications = get_all_notifications($conn);

    // Handle insertion of new notification if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $message = $_POST['message'];
        $recipient = $_POST['recipient'];
        $type = $_POST['type'];
        $date = date('Y-m-d');
        $is_read = 0; 

        $data = array($message, $recipient, $type, $date, $is_read);

        // Insert the notification
        if (insert_notification($conn, $data)) {
            $sm = "Notification added successfully";
            header("Location: ../src/admin-notification.php?success=$sm");
            exit();
        } else {
            $em = "Failed to add notification.";
        }
    }

    $users = get_all_users($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Css/Styles.css">
</head>
<body>
    <?php include "../content/header.php"; ?>
    
    <div class="body">
        <?php include "../content/nav.php"; ?>

        <section class="section-1">
            <h4 class="title">Manage Notifications</h4>
            
            <!-- Success or error message -->
            <?php if (isset($success_message)) { ?>
                <div class="primary" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php } elseif (isset($error_message)) { ?>
                <div class="dark" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>

            <!-- Form to insert a new notification -->
            <form method="POST" action="../src/admin-notification.php">
                <div class="input-holder">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" required class="input-1"></textarea>
                </div>
                
                <div class="input-holder">
                        <label for="assigned_to">Assigned to</label>
                        <select 
                            id="recipient" 
                            name="recipient" 
                            class="input-1" 
                            required>
                            <option value="">Select employee</option>
                            <?php if ($users): ?>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id']; ?>">
                                        <?= htmlspecialchars($user['full_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                <div class="input-holder">
                    <label for="type">Type:</label>
                    <select name="type" id="type" class="input-1">
                        <option value="info">Info</option>
                        <option value="warning">Warning</option>
                        <option value="alert">Alert</option>
                    </select>
                </div>

                <button type="submit" class="edit-btn">Add Notification</button>
            </form>

            <!-- Display all notifications -->
            <h4>All Notifications</h4>
            <?php if ($notifications) { ?>
                <table class="main-table">
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Recipient</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th>Action</th>
                        
                    </tr>
                    <?php foreach ($notifications as $notification) { ?>
                        <tr>
                            <td><?php echo $notification['id']; ?></td>
                            <td><?php echo $notification['message']; ?></td>
                            <td><?php echo $notification['recipient']; ?></td>
                            <td><?php echo $notification['type']; ?></td>
                            <td><?php echo $notification['date']; ?></td>
                            <td><a href="../src/delete-notification.php?id=<?= $notification['id'] ?>" class="edit-btn">Delete Notification</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>No notifications found.</p>
            <?php } ?>
        </section>
    </div>

    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(5)"); // Adjust according to your nav structure
        active.classList.add("active");
    </script>
</body>
</html>

<?php
} else {
    // If the user is not an admin, redirect to login page
    header("Location: ../src/UserLogin.php?error=Unauthorized access");
    exit();
}
?>
