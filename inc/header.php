<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/Session.php';
Session::init();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Login Systems</title>
    <link rel="stylesheet" href="inc/bootstrap.min.css">
    <script src="inc/jquery.min.js" ></script>
    <script src="inc/bootstrap.min.js" ></script>

</head>
<?php
if (isset($_GET['action']) && $_GET['action'] == "logout"){
    session::destroy();
}
?>
<body>

    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand " href="index.php"> Login Register </a>
                </div>
                <ul class="nav navbar-nav pull-right">
                    <?php
                        $id = Session::get("id");
                        $userLogin= Session::get("login");
                        if ($userLogin==true){?>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="profile.php?id=<?php echo $id;?>">profile</a></li>
                        <li><a href="?action=logout">Logout</a></li>
                        <?php }else{?>
                            <li><a href="Login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                       <?php } ?>


                </ul>
            </div>
        </nav>