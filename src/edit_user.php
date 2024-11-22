<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) ) {
    include "../server/DatabaseConnection.php";
    include "../app/User.php";

    
    if (!isset($_GET['id'])){
        header("Location: src/users.php");
        exit();
    }
    $id = (int) $_GET['id'];
    $user = get_user_by_id($conn, $id);


    if ($user == 0){
        header("Location: src/users.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../Css/Styles.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "../content/header.php" ?>
	<div class="body">
	<?php include "../content/nav.php" ?>
		<section class="section-1">
            <h4 class="title">Edit Users <a href="../src/users.php">User</a></h4>
           <form class="form-1" method="POST" action="../app/update-user.php">
           <?php
            if(isset($_GET['error'])) {?>

             <div class="dark" role="alert">
            <?php echo stripslashes($_GET['error']); ?>
            </div>
            <?php } ?>

            <?php
            if(isset($_GET['success'])) {?>

            <div class="primary" role="alert">
            <?php echo stripslashes($_GET['success']); ?>
            </div>
            <?php } ?>
            <div class="input-holder">
                <label >Full Name</label>
                <input type="text" class="input-1" name="full_name" value="<?=$user['full_name']?>" placeholder="Full Name"><br>
            </div>
            <div class="input-holder">
                <label >Username</label>
                <input type="text" class="input-1" name="user_name" value="<?=$user['username']?>" placeholder="Username"><br>
            </div>
            <div class="input-holder">
                <label >Password</label>
                <input type="text" class="input-1" name="password" value="**********" placeholder="Password"><br>
            </div>
            <input type="text" name="id" value="<?=$user['id']?>" hidden>
        
            <button class="edit-btn">Update</button>
           </form>
		</section>
	</div>
<script>var active = document.querySelector("#navList li:nth-child(2)");
active.classList.add("active");</script>
</body>
</html>

<?php }else{ 
   $em = "First login";
   header("Location: UserLogin.php?error=$em");
   exit();
}
 ?>