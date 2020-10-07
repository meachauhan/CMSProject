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
            $query= "SELECT * FROM posts WHERE post_stauts= 'Published' ";
            $allposts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($allposts)){
            $post_id=$row['post_id'];
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_date=$row['post_date'];
            $post_img=$row['post_img'];
            $post_content=substr($row['post_content'],0,100);
            $post_status=$row['post_stauts'];
                if($post_status == 'Published'){
                 
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
                    by <a href="authorpost.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                <hr><a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
      <?php } }?> 
        
                

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
