<?php
include 'inc/header.php';
include 'lib/User.php';
Session::checkLogin();


?>
<?php
$user= new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $userLogin = $user->userLogin($_POST);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Login Form</h2>
    </div>
    <div class="panel-body">
        <div style="max-width: 600px;margin:0 auto">
   <?php
     if (isset($userLogin)){
      echo $userLogin;
     }
  ?>
            <form action="" method="POST">
                <div class="form-group dihedear">
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="username" class="form-control"  />
                </div>
                <div class="form-group dihedear">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" class="form-control"  />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"  />
                </div>
                   <div class="form-group">
                    <label for="cpassword">Conform Password</label>
                    <input type="password" id="cpassword" name="cpassword" class="form-control"  />
                </div>
                <button type="submit" name="login" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
