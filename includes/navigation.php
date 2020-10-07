<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php
                    $query= "SELECT * FROM categories";
                    $allcategories=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($allcategories)){
                        $cat_title=$row['cat_title'];
                        $cat_id=$row['cat_id'];
                        $category_class='';
                        $registration_class='';
                        $pagename=basename($_SERVER['PHP_SELF']);
                        $registration='registration.php';
                        if(isset($_GET['cat_id']) && $_GET['cat_id']==$cat_id){
                            $category_class='active';

                        }
                        elseif($pagename==$registration){
                            $registration_class='active';
                        }
                        echo"<li class='$category_class'><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                    <?php if(isLoggedIn()): ?>
                    <li>
                        <a href="admin/index.php">Admin</a>
                    </li>
                    <li>
                        <a href="admin/includes/logout.php">Logout</a>
                    </li>
                    <?php else:?>
                    <li>
                        <a href="admin/login.php">Login</a>
                    </li>
                    <?php endif;?>
                    <li>
                        <a href="admin/index.php">Admin</a>
                    </li>
                    <li class="<?php echo $registration_class; ?>">
                        <a href="registration.php">Registration</a>
                    </li>
                    <?php
                    
                    if(isset($_SESSION['username'])){
                       
                        if(isset($_GET['p_id'])){
                            $post_id=$_GET['p_id'];
                            echo "<li><a href='admin/posts.php?source=editpost&p_id=$post_id'>Edit Post</a></li>";    
                        }
                    }
                    
                    
                    
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>