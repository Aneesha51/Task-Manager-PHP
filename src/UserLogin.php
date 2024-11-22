<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/login.css">
    <title>Login</title>
</head>

<body>
    <section>
        <div class="login-container">
            <form method="POST" action="../app/login.php">
                <h2>User Login</h2>

                <?php if (isset($_GET['error'])): ?>
                    <div class="dark" role="alert">
                        <?php echo stripslashes($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <div class="primary" role="alert">
                        <?php echo stripslashes($_GET['success']); ?>
                    </div>
                <?php endif; ?>

                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" id="user_name" name="user_name" placeholder="User name">
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" id="password" name="password" placeholder="Enter password">
                </div>

                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" name="remember_me"> Remember me
                    </label>
                    <a href="#">Forgot Password</a>
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
