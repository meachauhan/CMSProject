<?php include"include/header.php"; 
    include "function.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "include/navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Subheading</small>
                        </h1>
<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Author</th>
                                   <th>Comment</th>
                                   <th>Email</th>
                                   <th>Status</th>
                                   <th>In Response to</th>
                                   <th>Date</th>
                                   <th>Approve</th>
                                   <th>unapprove</th>
                                   <th>Delete</th>
                                    <th>Edit</th>

                               </tr>
                           </thead>
                           <tbody>
                              <?php 
                               $query= "SELECT * FROM comments WHERE comment_post_id=".mysqli_real_escape_string($connection,$_GET['id'])." ";
                               $allcomments=mysqli_query($connection,$query);
                               if(!$allcomments){
                                die("Query failed".mysqli_error($connection));
                               }
                               while($row=mysqli_fetch_assoc($allcomments)){
                               $comment_id=$row['comment_id'];
                               $comment_post_id=$row['comment_post_id'];
                                $comment_author=$row['comment_author'];
                               $comment_email=$row['comment_email'];
                                $comment_content=$row['comment_content'];
                               $comment_status=$row['comment_status'];
                                $comment_date=$row['comment_date'];
                               
                               echo"<tr>";
                                echo"<td>$comment_id</td>";
                                echo"<td>$comment_author</td>";
                                echo"<td>$comment_content</td>";
//                                $query= "SELECT * FROM categories WHERE cat_id=$post_cat_id ";
//                                        $allcategories=mysqli_query($connection,$query);
//                                        while($row=mysqli_fetch_assoc($allcategories)){
//                                            $cat_title=$row['cat_title'];
//                                            $cat_id=$row['cat_id'];   
                                echo"<td>$comment_email</td>";
                                echo"<td>$comment_status</td>";
                                $query="SELECT * FROM posts WHERE post_id= $comment_post_id ";
                                   $selectpost=mysqli_query($connection,$query);
                                   while($row=mysqli_fetch_assoc($selectpost)){
                                       $post_title=$row['post_title'];
                                   
                                echo"<td><a href='../post.php?p_id=$comment_post_id '>$post_title</a></td>";
                                       }
                                echo"<td>$comment_date</td>";
                                echo"<td><a href='post_comments.php?approve={$comment_id}'>Approve</a></td>";
                                echo"<td><a href='post_comments.php?unaprove={$comment_id}'>Unaprrove</a></td>";
                                echo"<td><a href='post_comments.php?delete={$comment_id}&id=".$_GET['id']."'>Delete</a></td>";
                                echo"<td><a href='posts.php?source=editpost&p_id={$comment_id}'>Edit</a></td>";
                                echo"</tr>";
                                
                               
                               
//                               }
                               }
                               if(isset($_GET['unaprove'])){
                                   $comment_id=$_GET['unaprove'];
                                   $query="UPDATE comments SET comment_status='Unaproved' WHERE comment_id= $comment_id ";
                                   $delete=mysqli_query($connection,$query);
                                   header("Location: post_comments.php");
                               }
                               if(isset($_GET['approve'])){
                                   $comment_id=$_GET['approve'];
                                   $query="UPDATE comments SET comment_status='Approved' WHERE comment_id= $comment_id ";
                                   $delete=mysqli_query($connection,$query);
                                   header("Location: post_comments.php");
                               }
                               
                               
                               if(isset($_GET['delete'])){
                                   $comment_id=$_GET['delete'];
                                   $query="DELETE FROM comments WHERE comment_id={$comment_id} ";
                                   $delete=mysqli_query($connection,$query);
                                   header("Location: post_comments.php?id={$comment_post_id} ");
                               }
                               
                               
                               ?>
                               
                           </tbody>
                       </table>
                       </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "include/footer.php";?>
  