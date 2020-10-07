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
                        <div class="col-xs-6">
                           <?php 
                            insert_cat();
                            
                            ?>
                            <form action="" method="post" >
                                <label for="cat_title">Add Categroy</label>
                                 <div class="form-group">
                                     <input type="text" class="form-control" name="cat_title">
                                 </div>
                                 <div class="form-group">
                                     <input type="submit" class="btn btn-primary "name="submit" value="Add Category">
                                 </div>
                            </form>
                          <?php
                            if(isset($_GET['edit'])){
                                $cat_id=$_GET['edit'];
                                include "include/edit_cat.php";
                            }
                            ?>
                        </div>
                        <div class="col-xs-6">
                                    
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th> Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php showallcat(); ?>
                                            <?php
                                            delete();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "include/footer.php";?>