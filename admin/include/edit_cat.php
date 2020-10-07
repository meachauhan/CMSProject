
<form action="" method="post" >
<label for="cat_title">Edit Categroy</label>
<div class="form-group">
<?php
    if(isset($_GET['edit'])){
         $cat_id=$_GET['edit'];
        $query= "SELECT * FROM categories WHERE cat_id=$cat_id ";
        $allcategories=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($allcategories)){
            $cat_title=$row['cat_title'];
            $cat_id=$row['cat_id'];
            ?>
    
     <input value="<?php if(isset($cat_title)){ echo $cat_title; }?>" type="text" class="form-control" name="cat_title">
     <?php }} ?>
      <?php
            if(isset($_POST['update'])){
                $cat_title=$_POST['cat_title'];
                $stmt=mysqli_prepare($connection,"UPDATE categories SET cat_title=? WHERE cat_id=?");
                mysqli_stmt_bind_param($stmt,'si', $cat_title,$cat_id);
                mysqli_stmt_execute($stmt);   
                if(!$stmt){
                    echo"Query Failed".mysqli_error($connection);
                }
               
                redirect('categories.php');
            }?>
     
 </div>
 <div class="form-group">
     <input type="submit" class="btn btn-primary "name="update" value="Update Category">
 </div>
</form>