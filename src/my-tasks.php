<?php 
session_start();

if (isset($_SESSION['role'], $_SESSION['id'])) {
    include "../server/DatabaseConnection.php";
    include "../app/Task.php";
    include "../app/User.php";

    $tasks = get_all_tasks_by_id($conn, $_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Css/Styles.css">
</head>
<body>
    <input type="checkbox" id="checkbox">
    <?php include "../content/header.php"; ?>

    <div class="body">
        <?php include "../content/nav.php"; ?>

        <section class="section-1">
            <h4 class="title">My Tasks</h4>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="primary" role="alert">
                    <?= htmlspecialchars(stripslashes($_GET['success'])); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($tasks): ?>
                <table class="main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= htmlspecialchars($task['title']); ?></td>
                                <td><?= htmlspecialchars($task['description']); ?></td>
                                <td><?= htmlspecialchars($task['status']); ?></td>
                                <td><?= htmlspecialchars($task['due_date']); ?></td>
                                <td>
                                    <a href="../src/edit-employee-task.php?id=<?= $task['id']; ?>" class="edit-btn">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h3>Empty</h3>
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
    $em = "First login";
    header("Location: UserLogin.php?error=" . urlencode($em));
    exit();
}
?>
