<table class="table table-bordered table-hover">
<thead>
  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>First name</th>
    <th>Last name</th>
    <th>Email Id</th>
    <th>Role</th>
    <th>image</th>
    <th>Admin</th>
    <th>Subscriber</th>
    <th>Delete</th>
    <th>Edit</th>
  </tr>
  </thead>
<tbody>
  <?php 
    $query= "SELECT * FROM users ";
    $allusers=mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($allusers)){
      $user_id=$row['user_id'];
      $username=$row['username'];
      $user_password=$row['password'];
      $user_firstname=$row['user_firstname'];
      $user_lastname=$row['user_lastname'];
      $user_email=$row['user_email'];
      $user_role=$row['user_role'];
      $user_image=$row['user_image'];

      echo"<tr>";
      echo"<td>$user_id</td>";
      echo"<td>$username</td>";
      echo"<td>$user_firstname</td>";
      echo"<td> $user_lastname</td>";
      echo"<td>$user_email</td>";
      echo"<td>$user_role</td>";
      echo"<td><img class='img-responsive' width='100' src='../images/$user_image'></td>";
      echo"<td><a href='users.php?admin={$user_id}'>change to admin</a></td>";
      echo"<td><a href='users.php?subscriber={$user_id}'>change to subscriber</a></td>";
      echo"<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
      echo"<td><a href='users.php?source=edituser&u_id={$user_id}'>Edit</a></td>";
      echo"</tr>";

    }

    if(isset($_GET['subscriber'])){
      $user_id=$_GET['subscriber'];
      $query="UPDATE users SET user_role='Subscriber' WHERE user_id= $user_id ";
      $update_role=mysqli_query($connection,$query);
      header("Location: users.php");
      }
    if(isset($_GET['admin'])){
      $user_id=$_GET['admin'];
      $query="UPDATE users SET user_role='Admin' WHERE user_id= $user_id ";
      $update_role=mysqli_query($connection,$query);
      header("Location: users.php");}
    if(isset($_GET['delete'])){
      if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='Admin'){
          $user_id=$_GET['delete'];
          $query="DELETE FROM users WHERE user_id={$user_id} ";
          $delete=mysqli_query($connection,$query);
          header("Location: users.php");
          }
      }
    }


  ?>

</tbody>
</table>
