<?php 
session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "../server/DatabaseConnection.php";
    include "../app/Task.php";
    include "../app/User.php";

    // Set default text and fetch tasks based on due date filters
    $text = "All Task";
    
    if (isset($_GET['due_date']) && $_GET['due_date'] == "Due Today") {
        $text = "Due Today";
        $tasks = get_all_tasks_due_today($conn);
        $num_task = count_tasks_due_today($conn);

    } else if (isset($_GET['due_date']) && $_GET['due_date'] == "Overdue") {
        $text = "Overdue";
        $tasks = get_all_tasks_overdue($conn);
        $num_task = count_tasks_overdue($conn);

    } else if (isset($_GET['due_date']) && $_GET['due_date'] == "No Deadline") {
        $text = "No Deadline";
        $tasks = get_all_tasks_NoDeadline($conn);
        $num_task = count_tasks_NoDeadline($conn);

    } else {
        $tasks = get_all_tasks($conn);
        $num_task = count_tasks($conn);
    }

    $users = get_all_users($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Tasks</title>
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
            <h4 class="title-2">
                <!-- Links for task categories -->
                <a href="create-task.php" class="edit-btn">Create Task</a>
                <a href="../src/AllTasks.php?due_date=Due Today" class="edit-btn">Due Today</a>
                <a href="../src/AllTasks.php?due_date=Overdue" class="edit-btn">Overdue</a>
                <a href="../src/AllTasks.php?due_date=No Deadline" class="edit-btn">No Deadline</a>
                <a href="../src/AllTasks.php" class="edit-btn">All Tasks</a>
            </h4>

            <!-- Display task category and count -->
            <h4 class="title-2"><?= $text ?> (<?= $num_task ?>)</h4>

            <!-- Display success message if exists -->
            <?php if (isset($_GET['success'])) { ?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
            <?php } ?>

            <!-- Display tasks in a table format -->
            <?php if ($tasks != 0) { ?>
                <table class="main-table">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Assigned To</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php $i = 0; foreach ($tasks as $task) { ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= htmlspecialchars($task['title']) ?></td>
                            <td><?= htmlspecialchars($task['description']) ?></td>
                            <td>
                                <?php 
                                    foreach ($users as $user) {
                                        if ($user['id'] == $task['assigned_to']) {
                                            echo $user['full_name'];
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if ($task['due_date'] == "") {
                                        echo "No Deadline";
                                    } else {
                                        echo $task['due_date'];
                                    }
                                ?>
                            </td>
                            <td><?= htmlspecialchars($task['status']) ?></td>
                            <td>
                                <!-- Edit and Delete actions -->
                                <a href="Edit-task.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
                                <a href="delete-task.php?id=<?= $task['id'] ?>" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <!-- If no tasks available -->
                <h3>Empty</h3>
            <?php } ?>
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
    // Redirect to login page if not logged in or not an admin
    $em = "First login";
    header("Location: UserLogin.php?error=$em");
    exit();
}
?>
