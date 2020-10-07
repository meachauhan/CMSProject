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
            if(isset($_GET['page'])){
                $page=$_GET['page'];

            }else{
                $page="";
            }
            if($page=="" || $page==1){
                $page_1=0;

            }
            else{
                $page_1=($page*5)-5;
            }
            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='Admin'){
                $post_count="SELECT * FROM posts ";
             } else{
                $post_count="SELECT * FROM posts WHERE post_stauts='Published'";
             }  
// $post_count="SELECT * FROM posts WHERE post_stauts='Published'";
            $count=mysqli_query($connection,$post_count);
            if(!$count){
                die("Query failed:". mysqli_error($connection));
            }
            $post_no=mysqli_num_rows($count);
            if($post_no<1){
                echo"<h1>No Posts</h1>";
            }else{
            $post_no=ceil($post_no/5);
            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='Admin'){
                $query= "SELECT * FROM posts ORDER BY post_date DESC LIMIT $page_1,5  ";
             } else{
                $query= "SELECT * FROM posts WHERE post_stauts='Published' ORDER BY post_date DESC LIMIT $page_1,5  ";
             }  
            
            $allposts=mysqli_query($connection,$query);
            if (!$allposts) {
                die("Query failed". mysqli_error($connection));
            }
            while($row=mysqli_fetch_assoc($allposts)){
            $post_id=$row['post_id'];
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_date=$row['post_date'];
            $post_img=$row['post_img'];
            $post_content=substr($row['post_content'],0,100);
            $post_status=$row['post_stauts'];
                
                 
                ?>
          
                <!-- <h1><?php echo $page; ?></h1> -->
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
        <ul class="pager">
            <?php
            for($i=1; $i<=$post_no; $i++)
            {
                if($i==$page){
                         echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";

                }else{
                echo "<li><a href='index.php?page=$i'>$i</a></li>";
            }
                }

                ?>
        </ul>

        <?php include"includes/footer.php" ;?>
