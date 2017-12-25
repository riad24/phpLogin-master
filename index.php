<?php
        include 'inc/header.php';
        include 'lib/User.php';
        include_once 'lib/Session.php';
        Session::checkSession();
        $user= new User();
?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>User list <span class="pull-right">welcome!<strong>
                        <?php
                        $name = Session::get("name");
                        if (isset($name)){
                            echo $name;
                        }
                        ?>
                    </strong></span></h2>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <th width="20%">Serial</th>
                    <th width="20%">Name</th>
                    <th width="20%">Username</th>
                    <th width="20%">Email</th>
                    <th width="20%">Action</th>
    <?php
    $user= new User();
    $userdata=$user->getUserdata();
    if ($userdata){
        $i=0;
        foreach ($userdata as $data){
            $i++;
    ?>

                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $data["name"];?></td>
                        <td><?php echo $data["username"];?></td>
                        <td><?php echo $data["email"];?></td>
                        <td><a class="btn btn-primary" href="profile.php?id=<?php echo $data["id"];?>">View</a></td>
                    </tr>
<?php } }else{?>
        <tr><td colspan="5"><h2> No user data found....!</h2></td></tr>
        <?php }?>
                </table>

            </div>
        </div>
       <?php include 'inc/footer.php'; ?>