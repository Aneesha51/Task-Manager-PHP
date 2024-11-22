<?php
session_start();

if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "../server/DatabaseConnection.php";
    include "../app/User.php";
    $users = get_all_users($conn);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Users</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Css/Styles.css">
    </head>
    <body>
        <input type="checkbox" id="checkbox">
        <?php include "../content/header.php"; ?>
        
        <div class="body">
            <?php include "../content/nav.php"; ?>
            
            <section class="section-1">
                <h4 class="title">
                    Manage Users 
                    <a href="../src/add_user.php">Add User</a>
                </h4>
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="primary" role="alert">
                        <?= htmlspecialchars(stripslashes($_GET['success'])); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($users): ?>
                    <table class="main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ($users as $user): ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= htmlspecialchars($user['full_name']); ?></td>
                                    <td><?= htmlspecialchars($user['username']); ?></td>
                                    <td><?= htmlspecialchars($user['role']); ?></td>
                                    <td>
                                        <a href="../src/edit_user.php?id=<?= $user['id']; ?>" class="edit-btn">Edit</a>
                                        <a href="../src/delete-user.php?id=<?= $user['id']; ?>" class="delete-btn">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h3>No Users Found</h3>
                <?php endif; ?>
            </section>
        </div>
        
        <script>
            // Highlight the active navigation item
            const active = document.querySelector("#navList li:nth-child(2)");
            active.classList.add("active");
        </script>
    </body>
    </html>
    <?php
} else {
    $em = "Please log in first.";
    header("Location: UserLogin.php?error=" . urlencode($em));
    exit();
}
?>
