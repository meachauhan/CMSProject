<?php
if(isset($_GET['p_id']))
{
    $p_id=$_GET['p_id'];
}
 $query= "SELECT * FROM posts WHERE post_id=$p_id ";
$allposts=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($allposts)){
$post_author=$row['post_author'];
$post_title=$row['post_title'];
$post_cat_id=$row['post_cat_id'];
$post_stauts=$row['post_stauts'];
$post_image=$row['post_img'];
$post_comment_count=$row['post_comment_count'];
$post_tags=$row['post_tags'];
$post_date=$row['post_date'];
$post_content=$row['post_content'];
}

if(isset($_POST['edit_post'])){
    $post_title=$_POST['title'];
    $post_category=$_POST['post_category'];
    $post_author=$_POST['author'];
    $post_status=$_POST['post_status'];
    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
    if(empty([$post_image])){
    $query="SELECT * FROM posts WHERE post_id = $p_id "; 
    $selectimg=mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($selectimg)){
            $post_image=$row['post_img'];
        }
        if(!$selectimg){
            die("query failed".mysqli_error($connection));
        }
    
    }   
   
    
    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_date=date('d-m-y');
    $post_comment_count=4;
     move_uploaded_file($post_image_temp,"../images/$post_image");
    
    $query="UPDATE posts SET ";
    $query.="post_title='{$post_title}', ";
    $query.="post_cat_id='{$post_category}', ";
    $query.="post_author='{$post_author}', ";
    $query.="post_stauts='{$post_status}', ";
    $query.="post_tags='{$post_tags}', ";
    $query.="post_content='{$post_content}', ";
    $query.="post_date=now(), ";
    $query.="post_img='{$post_image}' ";
    $query.="WHERE post_id={$p_id} ";
    $updatepost=mysqli_query($connection,$query);
    echo"<p class='bg-success'>Post updated : "."<a href='../post.php?p_id=$p_id'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
}


?>
   

   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input  value="<?php echo $post_title; ?>" type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <br>
        <select class="form-group" name="post_category" id="">
         <?php
            $query= "SELECT * FROM categories ";
            $allcategories=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($allcategories)){
            $cat_title=$row['cat_title'];
            $cat_id=$row['cat_id'];
            if($cat_id==$post_cat_id){
                echo"<option selected value='{$cat_id}'>$cat_title</option>";
            }
            else{
                echo"<option value='{$cat_id}'>$cat_title</option>";
            }
            
            }
            ?>   
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post status</label><br>
           <select class="form-group" name="post_status" id="">
        <option value="<?php echo $post_stauts ?>"><?php echo $post_stauts ?></option>
         <?php
            if($post_status=='Published'){
                 echo"<option value='Draft'>Draft</option>"; 
            
            }
            else{
                echo"<option value='Published'>Publish</option>";
              
            }
            ?>   
            
        </select>
    </div>
    <div class="form-group">
       <label for="post_image">Post Image</label><br>
        <img src="../images/<?php echo $post_image;?>" width="100" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input  type="submit" name="edit_post" value="Update Post" class="btn bnt-primary">
    </div>
    
    
</form>




