<?php
if(isset($_POST['create_post']))
{
    $post_title=$_POST['title'];
    $post_category=$_POST['post_category'];
    $post_author=$_POST['author'];
    $post_status=$_POST['post_status'];
    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
    
    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_date=date('d-m-y');
//    $post_comment_count=4;
    move_uploaded_file($post_image_temp,"../images/$post_image");
    $query="INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_stauts) ";
    $query.="VALUES({$post_category},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
    $create_post=mysqli_query($connection,$query);
    if(!$create_post)
    {
        die("Query Failed". mysqli_error($connection));
    }
    $p_id=mysqli_insert_id($connection);   
    echo"<p class='bg-success'>Post Added: "."<a href='../post.php?p_id=$p_id'>View Posts</a> or <a href='posts.php?source=addpost'>Add More Posts</a></p>";
}

?>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="title" class="form-control">
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
            echo"<option value='{$cat_id}'>$cat_title</option>";
            }
            ?>   
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post status</label><br>
        <select class="form-group" name="post_status" id="">
        
            <option value='Draft'>Post Stauts</option>
            <option value='Published'>Publish</option>
            <option value='Draft'>Draft</option>
            
        
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="create_post" value="Publish Post" class="btn bnt-primary">
    </div>
    
    
</form>




