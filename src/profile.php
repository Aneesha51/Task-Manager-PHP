<?php 
session_start();

if (isset($_SESSION['role'], $_SESSION['id']) && $_SESSION['role'] === "employee") {
    include "../server/DatabaseConnection.php";
    include "../app/User.php";
    $user = get_user_by_id($conn, $_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Css/Styles.css">
</head>
<body>
    <input type="checkbox" id="checkbox">
    <?php include "../content/header.php"; ?>
    
    <div class="body">
        <?php include "../content/nav.php"; ?>
        
        <section class="section-1">
            <h4 class="title">Profile <a href="edit-profile.php">Edit Profile</a></h4>
            <table class="main-table" style="max-width: 300px;">
                <tr>
                    <td>Full Name</td>
                    <td><?= htmlspecialchars($user['full_name']); ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><?= htmlspecialchars($user['username']); ?></td>
                </tr>
                <tr>
                    <td>Joined At</td>
                    <td><?= htmlspecialchars($user['created_at']); ?></td>
                </tr>
            </table>
        </section>
    </div>

    <script>
        // Highlight the active navigation item
        const active = document.querySelector("#navList li:nth-child(3)");
        active.classList.add("active");
    </script>
</body>
</html>
<?php 
} else { 
    $em = "First login";
    header("Location: ../src/UserLogin.php?error=" . urlencode($em));
    exit();
}
?>
