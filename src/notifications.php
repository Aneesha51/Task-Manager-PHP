<?php 
session_start();

if (isset($_SESSION['role'], $_SESSION['id'])) {
    include "../server/DatabaseConnection.php";
    include "../app/Notification.php";

    $notifications = get_all_my_notifications($conn, $_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Css/Styles.css">
</head>
<body>
    <input type="checkbox" id="checkbox">
    <?php include "../content/header.php"; ?>
    
    <div class="body">
        <?php include "../content/nav.php"; ?>
        
        <section class="section-1">
            <h4 class="title">All Notifications</h4>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="primary" role="alert">
                    <?= htmlspecialchars(stripslashes($_GET['success'])); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($notifications): ?>
                <table class="main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Message</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($notifications as $notification): ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= htmlspecialchars($notification['message']); ?></td>
                                <td><?= htmlspecialchars($notification['type']); ?></td>
                                <td><?= htmlspecialchars($notification['date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h3>You have zero notifications</h3>
            <?php endif; ?>
        </section>
    </div>

    <script>
        // Highlight the active navigation item
        const active = document.querySelector("#navList li:nth-child(4)");
        active.classList.add("active");
    </script>
</body>
</html>
<?php 
} else { 
    $em = "First login";
    header("Location: UserLogin.php?error=" . urlencode($em));
    exit();
}
?>
