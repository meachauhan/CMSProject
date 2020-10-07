<?php
if(isset($_GET['u_id']))
{
    $u_id=$_GET['u_id'];
}
$query= "SELECT * FROM users WHERE user_id=$u_id ";
$alluser=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($alluser)){
$user_id=$row['user_id']; 
$username=$row['username'];
$password=$row['password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];
$user_role=$row['user_role'];
$user_image=$row['user_image'];
$randsalt=$row['randsalt'];
}
$password=crypt($password, $randsalt);
if(isset($_POST['edit_user'])){
       $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $username=$_POST['username'];
    $u_password=$_POST['password'];
    $user_email=$_POST['user_email'];
    $user_role=$_POST['user_role'];
    $user_image=$_FILES['image']['name'];
    $user_image_temp=$_FILES['image']['tmp_name'];
    if(empty([$user_image])){
    $query="SELECT * FROM users WHERE user_id = $u_id "; 
    $selectimg=mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($selectimg)){
            $user_image=$row['user_img'];
        }
        if(!$selectimg){
            die("query failed".mysqli_error($connection));
        }
    
    }   
   
     move_uploaded_file($user_image_temp,"../images/$user_image");
    if(!empty($password)){
        $query="SELECT password FROM users WHERE user_id=$user_id ";
        $getpass=mysqli_query($connection,$query);
        $row=mysqli_fetch_assoc($getpass);
        $dbpassword=$row['password'];

    }
    $hashedpass=password_hash($u_password, PASSWORD_BCRYPT,  array('cost' =>12 ));
    $query="UPDATE users SET ";
    $query.="user_firstname='{$user_firstname}', ";
    $query.="user_lastname='{$user_lastname}', ";
    $query.="username='{$username}', ";
    $query.="password='{$hashedpass}', ";
    $query.="user_email='{$user_email}', ";
    $query.="user_role='{$user_role}', ";
//    $query.="post_date=now(), ";
    $query.="user_image='{$user_image}' ";
    $query.="WHERE user_id={$u_id} ";
    $updateuser=mysqli_query($connection,$query);
}

?>
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
        <label for="user_role">User Role</label>
        <br>
        <select  class="form-group" name="user_role" id="">
         <option value="<?php echo $user_role; ?>"><?php echo $user_role ; ?></option>
         <?php
            if($user_role=='Admin'){
                echo"<option value='Subscriber'>Subscriber</option>";
            }
            else
            {
                echo" <option value='Admin'>Admin</option>";
            }
            
            ?>
        
         
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>"  type="text" name="username" class="form-control">
    </div>
     <div class="form-group">
        <label for="post_tags">Password</label>
        <input value="<?php echo $u_password; ?>"  type="text" name="password" class="form-control">
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
        <input type="submit" name="edit_user" value="Update User" class="btn bnt-primary">
    </div>
    
    
</form>
