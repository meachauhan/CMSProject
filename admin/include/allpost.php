<?php
if(isset($_POST['checkBoxArray']))
{
    foreach($_POST['checkBoxArray'] as $checkboxvalue){
        $bulkoption=$_POST['bulk_option'];
        switch($bulkoption){
            case 'Published':
                $query="UPDATE posts SET post_stauts='{$bulkoption}' WHERE post_id= {$checkboxvalue} ";
                $updatetopublish=mysqli_query($connection,$query);
                break;
            case 'Draft':
                $query="UPDATE posts SET post_stauts='{$bulkoption}' WHERE post_id= {$checkboxvalue} ";
                $updatetodraft=mysqli_query($connection,$query);
                break;
            case 'delete':
                $query="DELETE FROM posts WHERE post_id= {$checkboxvalue} "; 
                $deletepost=mysqli_query($connection,$query);
                break;
            case 'clone':
                $query="SELECT * FROM posts WHERE post_id= {$checkboxvalue} "; 
                $clonepost=mysqli_query($connection,$query);
                while ($row=mysqli_fetch_assoc($clonepost)) {
                  $post_title=$row['post_title'];
                  $post_category=$row['post_cat_id'];
                  $post_author=$row['post_author'];
                  $post_status=$row['post_stauts'];
                  $post_image=$row['post_img'];
                  $post_tags=$row['post_tags'];
                  $post_content=$row['post_content'];
                  // $post_date=date('d-m-y');
                  $query="INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_stauts) ";
                  $query.="VALUES({$post_category},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
                  $create_post=mysqli_query($connection,$query);
                  if(!$create_post)
                  {
                      die("Query Failed". mysqli_error($connection));
                  }

                                              }
                break;
        }
    }
}



?>
<form  action="" method="post">
<table class="table table-bordered table-hover">
<div id="bulkOptionContainer"  class="col-xs-4 left">

<select name="bulk_option" id="" class="form-control">
  <option>Select Option</option>
  <option value="Published">Publish</option>
  <option value="Draft">Draft</option>
  <option value="delete">Delete</option>
  <option value="clone">Clone</option>
</select>
</div>
<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=addpost">Add new</a><br>
</div>

<thead>
<tr>
  <th><input type="checkbox" id="selectAllBoxes"></th>
   <th>ID</th>
   <th>Author</th>
   <th>Title</th>
   <th>Categories</th>
   <th>Status</th>
   <th>Image</th>
   <th>Tags</th>
   <th>Comments</th>
   <th>Date</th>
   <th>View Post</th>
   <th>Delete</th>
   <th>Edit</th>
   <th>Views</th>
</tr>
</thead>
<tbody>
<?php 
// $query= "SELECT * FROM posts ORDER BY post_date DESC";  
$query= "SELECT posts.post_id,posts.post_author,posts.post_title,posts.post_cat_id,posts.post_stauts,posts.post_img, ";
$query .="posts.post_comment_count,posts.post_tags,posts.post_date,posts.post_views,categories.cat_id,categories.cat_title ";
$query .="FROM posts ";
$query .="LEFT JOIN categories ON posts.post_cat_id=categories.cat_id ORDER BY post_date DESC ";
$allposts=mysqli_query($connection,$query);
if(!$allposts){
  die("Query failed" . mysqli_error($connection));
}
while($row=mysqli_fetch_assoc($allposts)){
$post_id            =$row['post_id'];
$post_author        =$row['post_author'];
$post_title         =$row['post_title'];
$post_cat_id        =$row['post_cat_id'];
$post_stauts        =$row['post_stauts'];
$post_img           =$row['post_img'];
$post_comment_count =$row['post_comment_count'];
$post_tags          =$row['post_tags'];
$post_date          =$row['post_date'];
$post_views         =$row['post_views'];
$cat_title          =$row['cat_title'];
$cat_id             =$row['cat_id'];


echo"<tr>";?>

<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
<?php echo"<td>$post_id</td>";
echo"<td>$post_author</td>";
echo"<td>$post_title</td>"; 
echo"<td>$cat_title</td>";
echo"<td>$post_stauts</td>";
echo"<td><img class='img-responsive' width='100' src='../images/$post_img'></td>";
echo"<td>$post_tags</td>";
$query="SELECT * FROM comments WHERE comment_post_id= $post_id ";
$commentquery=mysqli_query($connection,$query);
$row=mysqli_fetch_array($commentquery);
$comment_id=$row['comment_id'];
$post_comment_count=mysqli_num_rows($commentquery);
echo"<td><a href='post_comments.php?id=$post_id'>$post_comment_count</a></td>";
echo"<td>$post_date</td>";
echo"<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>View Post</a></td>";  
?>
<form method="post">
  <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
  
  <td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>
  
</form>
<?php 
echo"<td><a class='btn btn-primary' href='posts.php?source=editpost&p_id={$post_id}'>Edit</a></td>";
echo "<td><a href='posts.php?reset={$post_id}'>$post_views</a></td>";
echo"</tr>";
}
if(isset($_POST['delete'])){
   $post_id=$_POST['post_id'];
   $query="DELETE FROM posts WHERE post_id={$post_id} ";
   $delete=mysqli_query($connection,$query);
   header("Location: posts.php");
}
if(isset($_GET['reset'])){
   $post_id=$_GET['reset'];
   $query="UPDATE posts SET post_views=0 WHERE post_id={$post_id} ";
   $reset=mysqli_query($connection,$query);
   header("Location: posts.php");
}
?>

</tbody>
</table>
</form>
