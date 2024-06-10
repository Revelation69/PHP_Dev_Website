<?php 
    include('functions.php');

    if (!isLoggedIn()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (!isAdmin()) {
        $_SESSION['msg'] = "You must be an admin to access this page";
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Create User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Admin - Create User</h2>
    </div>
    <form method="post" action="create_user.php">
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
            <label>User type</label>
            <select name="user_type" id="user_type">
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
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
            <button type="submit" class="btn" name="register_btn">Create User</button>
        </div>
    </form>
</body>
</html>