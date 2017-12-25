



<?php
include 'lib/User.php';
include 'inc/header.php';
Session::checkSession();

?>
<?php

if (isset($_GET["id"])){
    $id= (int)$_GET["id"];
    $sessId=Session::get("id");
    if ($sessId !=$id){
        header("Location: index.php");

    }
}
$user= new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $Changepss = $user->Updatepassword($id, $_POST);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Password Change <span class="pull-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $id;?>">Back</a></h2>
    </div>
    <div class="panel-body">
        <div style="max-width: 600px;margin:0 auto">
            <?php
            if (isset($Changepss)){
                echo $Changepss;
            } ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="old_password">old Password</label>
                        <input type="password" id="old_password" name="old_password" class="form-control"   />
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" class="form-control"  />
                    </div>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                </form>

        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
