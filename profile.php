



<?php
include 'lib/User.php';
include 'inc/header.php';
Session::checkSession();

?>
<?php

    if (isset($_GET["id"])){
        $id= (int)$_GET["id"];
    }
    $user= new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $userUpdate = $user->userUpdate($id, $_POST);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Profile <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></h2>
    </div>
    <div class="panel-body">
        <div style="max-width: 600px;margin:0 auto">
     <?php
     if (isset($userUpdate)){
         echo $userUpdate;
     }
     ?>

   <?php
   $userdata= $user->getuserByID($id);
        if ($userdata){
   ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $userdata->name;?>"  />
                </div>
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text" id="Username" name="username" class="form-control" value="<?php echo $userdata->username;?>"  />
                </div>
                <div class="form-group">
                    <label for="password">Email Address</label>
                    <input type="text" id="email" name="email" class="form-control"  value="<?php echo $userdata->email;?>" />
                </div>
                <?php
                $sessId=Session::get("id");
                if ($sessId==$id){
                ?>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <a class="btn btn-info" href="changePssword.php?id=<?php echo $id;?>">Password Change</a>
                <?php }?>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
