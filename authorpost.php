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
                
            if(isset($_GET['p_id'])){
                $post_id=$_GET['p_id'];
                 $post_author=$_GET['author'];
            }    
                
            $query= "SELECT * FROM posts WHERE post_author= '{$post_author}' ";
            $allposts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($allposts)){
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_date=$row['post_date'];
            $post_img=$row['post_img'];
            $post_content=$row['post_content'];?>
          

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                
                <hr>
      <?php }?> <!-- Blog Comments -->
                <?php
                    if(isset($_POST['create_comment']))    
                    {   
                        $post_id=$_GET['p_id'];
                        $comment_author=$_POST['comment_author'];
                        $author_email=$_POST['author_email'];
                        $comment_content=$_POST['comment_content'];
                        if(!empty($comment_author) && !empty($author_email) && !empty($comment_content)){
                        $query="INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status, comment_date) ";
                        $query.="VALUES($post_id,'{$comment_author}','{$author_email}','{$comment_content}','unapproved',now()) ";
                        $addcomment=mysqli_query($connection,$query);
                        $query="UPDATE posts SET post_comment_count= post_comment_count+1 ";
                        $query.="WHERE post_id=$post_id ";
                        $updatecommentcount=mysqli_query($connection,$query);
                        }
                        else
                        {
                            echo'<script>alert("The field cant be blank")</script>';
                        }
                    }
                ?>
                <!-- Comments Form -->
<!--
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post"role="form">
                       <div class="form-group">
                            <lable>Author name</lable>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <lable>Author email</lable>
                            <input type="email" class="form-control" name="author_email">
                        </div>
                        <div class="form-group">
                             <lable>Add comment</lable>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                      
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
-->

              
                
                
                <!-- Comment -->
<!--
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
-->
                        <!-- Nested Comment -->
<!--
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
-->
                        <!-- End Nested Comment -->
<!--
                    </div>
                </div>
-->
        
                

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
