<?php
function redirect($location){
    return header("Location:".$location);
}
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}
function insert_cat(){
if(isset($_POST['submit'])){
global $connection;
$cat_title=$_POST['cat_title'];
if($cat_title== ""|| empty($cat_title)){
    echo"This field should not be empty";
}
else
{
    $stmt=mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUE(?) ");
    mysqli_stmt_bind_param($stmt,'s', $cat_title);
    mysqli_stmt_execute($stmt);   
    if(!$stmt){
        echo"Query Failed".mysqli_error($connection);
    }
}
}
}
function showallcat(){
    global $connection;
$query= "SELECT * FROM categories  ";
$allcategories=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($allcategories)){
 $cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];
echo"<tr>";
echo"<td>{$cat_id}</td>";
echo"<td>{$cat_title}</td>";
echo"<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
echo"<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
echo"</tr>";
            }    

}
function delete(){
    global $connection;
    if(isset($_GET['delete'])){
        $cat_id=$_GET['delete'];
        $query="DELETE FROM categories WHERE cat_id={$cat_id} ";
        $delete=mysqli_query($connection,$query);
        header("Location: categories.php");
        }
}


function useronline()
{
    if(isset($_GET['onlineuser'])){
    global $connection;
    if(!$connection){
        session_start();
        include "../includes/db.php";
    
    $session = session_id();
$time=time();
$timeoutins=05;
$timeout=$time-$timeoutins;
$query="SELECT * FROM user_online WHERE session='$session'";
$sendquery=mysqli_query($connection,$query);
$count=mysqli_num_rows($sendquery);
if($count==NULL)
{
    mysqli_query($connection,"INSERT INTO user_online(session,tim) VALUES ('$session','$time')");
}
else{
     mysqli_query($connection,"UPDATE user_online SET tim='$time' WHERE session='$session'");
}
$useronline= mysqli_query($connection,"SELECT * FROM user_online WHERE tim > '$timeout'");
echo $onlinecount=mysqli_num_rows($useronline);

}



}
}
useronline();
function  recordcount($table){
    global $connection;
    $query="SELECT * FROM " . $table ;
    $allcomments=mysqli_query($connection,$query);
    if(!$allcomments){
    echo"Query Failed".mysqli_error($connection);
    }
    $result=mysqli_num_rows($allcomments);
    return $result;

}

function checkstatus($table,$column,$stauts){
    global $connection;
    $query="SELECT * FROM $table WHERE $column = '$stauts'";
    $result=mysqli_query($connection,$query);
    return mysqli_num_rows($result);
}
function userexists($username){
    global $connection;
    $query="SELECT username FROM users WHERE username='$username'";
    $userexists=mysqli_query($connection,$query);
    if(mysqli_num_rows($userexists)>0){
        return true;
    }else{
        return false;
    }
}
function emailexists($email){
    global $connection;
    $query="SELECT user_email FROM users WHERE user_email='$email'";
    $emailexists=mysqli_query($connection,$query);
    if(mysqli_num_rows($emailexists)>0){
        return true;
    }else{
        return false;
    }
}
function register_user($username,$email,$password){
    global $connection;
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $username=mysqli_real_escape_string($connection,$username);
    $email=mysqli_real_escape_string($connection,$email);
    $password=mysqli_real_escape_string($connection,$password);
    if (userexists($username)) {
        echo'<script>alert("Username exists") </script>';
    }else{
    $password=password_hash($password, PASSWORD_BCRYPT,  array('cost' =>12 ));
        $query="INSERT INTO users(username,password,user_email,user_role) ";
        $query.="VALUES('{$username}','{$password}', '{$email}','Subscriber') ";
        $adduser=mysqli_query($connection,$query);
                 echo'<script>alert("Your registration has been submitted ") </script>';

    
}
}

function loginuser($username,$password){
    global $connection;
    $username=trim($username);
    $password=trim($password);
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    $query= "SELECT * FROM users WHERE username = '{$username}' ";
    $selectuser=mysqli_query($connection,$query);
    if(!$selectuser){
        die("query failed".mysqli_error($connection));
    }
    while($row=mysqli_fetch_array($selectuser)){
            $user_id=$row['user_id'];
            $db_username=$row['username'];
            $user_password=$row['password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_email=$row['user_email'];
            $user_role=$row['user_role'];
            $user_image=$row['user_image'];  }
  if(password_verify($password,$user_password)){
        $_SESSION['username']= $db_username;
        $_SESSION['user_firstname']= $user_firstname;
        $_SESSION['user_lastname']= $user_lastname;
        $_SESSION['user_email']= $user_email;
        $_SESSION['user_role']= $user_role;
        redirect('/cms/admin');}
    else{
        redirect('cms/index.php');
    }
}
function IfItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD']==strtoupper($mehtod)){
        return true;
    }
}
function isLoggedIn(){
    if(isset($_SESSION['username']))
    {
        return true;
    }
    return false;
}
function checkIsLoggedInAndRedirect($location=null){
    if(isLoggedIn()){
        redirect($location);
    }
}
?>
  
             