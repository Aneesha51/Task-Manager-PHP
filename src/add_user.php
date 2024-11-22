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
        <title>Add User</title>
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
                    Add Users 
                    <a href="../src/users.php">User</a>
                </h4>
                
                <form class="form-1" method="POST" action="../app/add-user.php">
                    <?php if (isset($_GET['error'])): ?>
                        <div class="dark" role="alert">
                            <?= htmlspecialchars(stripslashes($_GET['error'])); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_GET['success'])): ?>
                        <div class="primary" role="alert">
                            <?= htmlspecialchars(stripslashes($_GET['success'])); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="input-holder">
                        <label for="full_name">Full Name</label>
                        <input 
                            type="text" 
                            class="input-1" 
                            id="full_name" 
                            name="full_name" 
                            placeholder="Full Name" 
                            required>
                    </div>
                    <br>
                    
                    <div class="input-holder">
                        <label for="user_name">Username</label>
                        <input 
                            type="text" 
                            class="input-1" 
                            id="user_name" 
                            name="user_name" 
                            placeholder="Username" 
                            required>
                    </div>
                    <br>
                    
                    <div class="input-holder">
                        <label for="password">Password</label>
                        <input 
                            type="password" 
                            class="input-1" 
                            id="password" 
                            name="password" 
                            placeholder="Password" 
                            required>
                    </div>
                    <br>
                    
                    <button type="submit" class="edit-btn">Add User</button>
                </form>
            </section>
        </div>
        
        <script>
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
