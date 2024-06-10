<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Welcome to Revon Hub</h2>
        <h3>Register</h3>
    </div>
    <form method="post" action="register.php">
        <?php echo display_error(); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1" pattern=".{8,16}" placeholder="Password Must Be 8 Characters">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2" pattern=".{8,16}" placeholder="Password Must Be 8 Characters">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="register_btn">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>
</html>