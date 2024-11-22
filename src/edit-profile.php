<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
    include "../server/DatabaseConnection.php";
    include "../app/User.php";
    $user = get_user_by_id($conn, $_SESSION['id']);
    
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../Css/Styles.css">

</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "../content/header.php" ?>
	<div class="body">
		<?php include "../content/nav.php" ?>
		<section class="section-1">
			<h4 class="title">Edit Profile <a href="../src/profile.php">Profile</a></h4>
         <form class="form-1"
			      method="POST"
			      action="../app/update-profile.php">
			      <?php if (isset($_GET['error'])) {?>
      	  	<div class="dark" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>

      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="primary" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php } ?>
				<div class="input-holder">
					<lable>Full Name</lable>
					<input type="text" name="full_name" class="input-1" placeholder="Full Name" value="<?=$user['full_name']?>"><br>
				</div>

				<div class="input-holder">
					<lable>Old Password</lable>
					<input type="text" value="**********" name="password" class="input-1" placeholder="Old Password"><br>
				</div>
				<div class="input-holder">
					<lable>New Password</lable>
					<input type="text" name="new_password" class="input-1" placeholder="New Password"><br>
				</div>
				<div class="input-holder">
					<lable>Confirm Password</lable>
					<input type="text" name="confirm_password" class="input-1" placeholder="Confirm Password"><br>
				</div>

				<button class="edit-btn">Change</button>
			</form>

		</section>
	</div>

<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(3)");
	active.classList.add("active");
</script>
</body>
</html>
<?php }else{ 
   $em = "First login";
   header("Location: UserLogin.php?error=$em");
   exit();
}
 ?>