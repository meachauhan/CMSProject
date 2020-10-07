<?php
if(isset($_POST['create_user']))
{
//    $user_id=$_POST['user_id'];
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $user_email=$_POST['user_email'];
    $user_role=$_POST['user_role'];
    $user_image=$_FILES['image']['name'];
    $user_image_temp=$_FILES['image']['tmp_name'];
//    
    
//    $post_date=date('d-m-y');
//    $post_comment_count=4;
    move_uploaded_file($user_image_temp,"../images/$user_image");
    $password=password_hash($password, PASSWORD_BCRYPT,array('count' =>10));
    $query="INSERT INTO users(username,password,user_firstname,user_lastname,user_email,user_role,user_image) ";
    $query.="VALUES('{$username}','{$password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}','{$user_image}') ";
    $create_user=mysqli_query($connection,$query);
    if(!$create_user)
    {
        die("Query Failed". mysqli_error($connection));
    }
    echo"User Created: "."<a href='users.php'>View users</a>";
}

?>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <br>
        <select class="form-group" name="user_role" id="">
         <option value="select_option">Select Option</option>
         <option value="Admin">Admin</option>
         <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
     <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="text" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Email_Id</label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="image">
    </div>
   
    
    <div class="form-group">
        <input type="submit" name="create_user" value="Create User" class="btn bnt-primary">
    </div>
    
    
</form>




