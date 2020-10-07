<?php include"include/header.php"; 
    include "function.php"; ?>
    <?php
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];

    if(isset($_POST['edit_user'])){
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $user_email=$_POST['user_email'];
//    $user_image=$_FILES['image']['name'];
//    $user_image_temp=$_FILES['image']['tmp_name'];
//    if(empty([$user_image])){
//    $query="SELECT * FROM users WHERE user_id = $u_id "; 
//    $selectimg=mysqli_query($connection,$query);
//        while($row=mysqli_fetch_array($selectimg)){
//            $user_image=$row['user_img'];
//        }
//        if(!$selectimg){
//            die("query failed".mysqli_error($connection));
//        }
//    
//    }   
   
//     move_uploaded_file($user_image_temp,"../images/$user_image");
    $query="UPDATE users SET  ";
    $query.="user_firstname='{$user_firstname}', ";
    $query.="user_lastname='{$user_lastname}', ";
    $query.="username='{$username}', ";
    $query.="password='{$password}', ";
    $query.="user_email='{$user_email}', ";
//    $query.="post_date=now(), ";
//    $query.="user_image='{$user_image}' ";
    $query.="WHERE username='{$username}' ";
    $updateuser=mysqli_query($connection,$query);

    }

    $query="SELECT * FROM users WHERE username='{$username}'";
    $profile=mysqli_query($connection,$query);
    while($row= mysqli_fetch_array($profile)){
          $user_id=$row['user_id'];
                               $username=$row['username'];
                                $password=$row['password'];
                                $user_firstname=$row['user_firstname'];
                               $user_lastname=$row['user_lastname'];
                                $user_email=$row['user_email'];
                               $user_image=$row['user_image'];
    }
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "include/navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Subheading</small>
                        </h1>
                       
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input value="<?php echo $user_lastname; ?>"  type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>"  type="text" name="username" class="form-control">
    </div>
     <div class="form-group">
        <label for="post_tags">Password</label>
        <input autocomplete="off"  type="text" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Email_Id</label>
        <input value="<?php echo $user_email; ?>"  type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label><br>
        <img src="../images/<?php echo $user_image;?>" width="100" alt="">
        <input type="file" name="image">
    </div>
   
    
    <div class="form-group">
        <input type="submit" name="edit_user" value="Update Profile" class="btn bnt-primary">
    </div>
    
    
</form>
                         </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "include/footer.php";?>