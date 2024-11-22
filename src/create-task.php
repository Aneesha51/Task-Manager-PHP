<?php 
session_start();

if (isset($_SESSION['role'], $_SESSION['id']) && $_SESSION['role'] === "admin") {
    include "../server/DatabaseConnection.php";
    include "../app/User.php";

    $users = get_all_users($conn);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Task</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Css/Styles.css">
    </head>
    <body>
        <input type="checkbox" id="checkbox">
        <?php include "../content/header.php"; ?>
        
        <div class="body">
            <?php include "../content/nav.php"; ?>
            
            <section class="section-1">
                <h4 class="title">Create Task</h4>
                
                <form class="form-1" method="POST" action="../app/add-task.php">
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
                        <label for="title">Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="input-1" 
                            placeholder="Title" 
                            required>
                    </div>
                    <div class="input-holder">
                        <label for="description">Description</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            class="input-1" 
                            placeholder="Description" 
                            required></textarea>
                    </div>
                    <div class="input-holder">
                        <label for="due_date">Due Date</label>
                        <input 
                            type="date" 
                            id="due_date" 
                            name="due_date" 
                            class="input-1" 
                            required>
                    </div>
                    <div class="input-holder">
                        <label for="assigned_to">Assigned to</label>
                        <select 
                            id="assigned_to" 
                            name="assigned_to" 
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
                    <button type="submit" class="edit-btn">Create Task</button>
                </form>
            </section>
        </div>
        
        <script>
            const active = document.querySelector("#navList li:nth-child(3)");
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
