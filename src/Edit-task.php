<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "../server/DatabaseConnection.php";
    include "../app/Task.php";
    include "../app/User.php";

    // Check if 'id' is present in the URL
    if (!isset($_GET['id'])) {
        header("Location: tasks.php");
        exit();
    }

    $id = $_GET['id'];
    $task = get_task_by_id($conn, $id);

    // If task not found, redirect to tasks page
    if ($task == 0) {
        header("Location: tasks.php");
        exit();
    }

    // Fetch all users to populate the "assigned to" dropdown
    $users = get_all_users($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Css/Styles.css">
</head>
<body>
    <!-- Hidden checkbox for sidebar toggle -->
    <input type="checkbox" id="checkbox">

    <!-- Include the header -->
    <?php include "../content/header.php"; ?>

    <div class="body">
        <!-- Include the sidebar/navigation -->
        <?php include "../content/nav.php"; ?>

        <section class="section-1">
            <h4 class="title">Edit Task <a href="../src/AllTasks.php">Tasks</a></h4>

            <!-- Form to edit task details -->
            <form class="form-1" method="POST" action="../app/update-task.php">
                
                <!-- Display error message if exists -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="dark" role="alert">
                        <?php echo stripcslashes($_GET['error']); ?>
                    </div>
                <?php } ?>

                <!-- Display success message if exists -->
                <?php if (isset($_GET['success'])) { ?>
                    <div class="primary" role="alert">
                        <?php echo stripcslashes($_GET['success']); ?>
                    </div>
                <?php } ?>

                <!-- Title input -->
                <div class="input-holder">
                    <label>Title</label>
                    <input type="text" name="title" class="input-1" placeholder="Title" value="<?= htmlspecialchars($task['title']); ?>"><br>
                </div>

                <!-- Description input -->
                <div class="input-holder">
                    <label>Description</label>
                    <textarea name="description" rows="5" class="input-1"><?= htmlspecialchars($task['description']); ?></textarea><br>
                </div>

                <!-- Due date input -->
                <div class="input-holder">
                    <label>Snooze</label>
                    <input type="date" name="due_date" class="input-1" value="<?= htmlspecialchars($task['due_date']); ?>"><br>
                </div>

                <!-- Assigned to user dropdown -->
                <div class="input-holder">
                    <label>Assigned to</label>
                    <select name="assigned_to" class="input-1">
                        <option value="0">Select employee</option>
                        <?php if ($users != 0) { 
                            foreach ($users as $user) {
                                // If user is already assigned to the task, mark the option as selected
                                $selected = ($task['assigned_to'] == $user['id']) ? 'selected' : '';
                                echo "<option value='{$user['id']}' $selected>{$user['full_name']}</option>";
                            } 
                        } ?>
                    </select><br>
                </div>

                <!-- Hidden task ID input -->
                <input type="text" name="id" value="<?= htmlspecialchars($task['id']); ?>" hidden>

                <!-- Submit button -->
                <button class="edit-btn">Update</button>
            </form>
        </section>
    </div>

    <!-- Activate the current menu item in the sidebar -->
    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(4)");
        active.classList.add("active");
    </script>
</body>
</html>

<?php 
} else { 
    // Redirect to login page if the user is not logged in or not an admin
    $em = "First login";
    header("Location: UserLogin.php?error=$em");
    exit();
}
?>
