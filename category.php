<?php 
include "includes/db.php";

include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include"includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if(isset($_GET['cat_id'])){
                    $cat_id=$_GET['cat_id'];
            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='Admin'){
              $stmt1= mysqli_prepare($connection,"SELECT post_id, post_title, post_author, post_date, post_img, post_content FROM posts WHERE post_cat_id= ? ");
             } else{
                $stmt2=mysqli_prepare($connection,"SELECT post_id, post_title, post_author, post_date, post_img, post_content FROM posts WHERE post_cat_id= ? AND post_stauts=? ");
                $published='Published';
             }  
            if (isset($stmt1)) {
                mysqli_stmt_bind_param($stmt1,"i",$cat_id);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_img, $post_content);
                $stmt=$stmt1;
            }
            else{
                mysqli_stmt_bind_param($stmt2,"is",$cat_id,$published);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_img, $post_content);
                $stmt=$stmt2;

            }
            if (mysqli_stmt_num_rows($stmt)===0) {
                echo "<h1>No Posts</h1>";
            }
            while(mysqli_stmt_fetch($stmt)):
                ?>
          

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
      <?php endwhile; }?> 
        
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include"includes/sidebar.php"; ?>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include"includes/widget.php";?>

            </div>

        </div>
        <!-- /.row -->

        <?php include"includes/footer.php" ;?>
