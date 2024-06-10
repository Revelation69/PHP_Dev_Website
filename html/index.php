<?php 
include('functions.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script> 
    <title>Welcome to Revon Hub</title>
</head>
<body>
    <div class="header"></div>
    <div class="content">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3>
                    <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class="profile_info">
            <div>
                <?php  if (isset($_SESSION['user'])) : ?>
                    <strong><?php echo $_SESSION['user']['username']; ?></strong>
                    <small>
                        <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                        <br>
                        <a href="index.php?logout='1'" style="color: red;">logout</a>
                    </small>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="Logo">
        <a href="index.php">
            <img src="img/DevOps.png" alt="Snow2" width="400" height="150">
        </a>
    </div>
  
        <h1>Welcome to REVON HUB</h1>
        <p>Your Ultimate Destination for Project-Based DevOps Learning</p>
        <p>The best way to master DevOps is through hands-on experience and real-world projects.</p>
    </div>
</body>
</html>
