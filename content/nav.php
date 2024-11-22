<nav class="side-bar">
			<div class="user-p">
				<img src="../Images/profile image.png">
				<h4>@<?=$_SESSION['username'] ?></h4>
			</div>

			<?php
			
			if($_SESSION['role'] == "employee"){
			?>

			<!-- Employee Navigation Bar -->
			<ul id="navList">
				<li>
					<a href="../src/index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="../src/my-tasks.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>My Tasks</span>
					</a>
				</li>
				<li>
					<a href="../src/profile.php">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					<a href="../src/notifications.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</a>
				</li>
				<li>
					<a href="../src/Logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
			<?php } else { ?>
				<!-- Admin Navigation Bar -->
			<ul id="navList">
				<li>
					<a href="../src/index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="../src/users.php">
						<i class="fa fa-users" aria-hidden="true"></i>
						<span>Manage Users</span>
					</a>
				</li>
				<li>
					<a href="../src/create-task.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span>Create Task</span>
					</a>
				</li>
				<li>
					<a href="../src/AllTasks.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>All Tasks</span>
					</a>
				</li>
				<li>
					<a href="../src/admin-notification.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</a>
				</li>
				<li>
					<a href="../src/Logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
			<?php }?>

		</nav>