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
                       <?php
                        if(isset($_GET['source'])){
                            $source=$_GET['source'];
                        }
                        else{
                            $source='';
                        }
                            switch($source){
                                case 'adduser';
                                    {
                                        include "include/addusers.php";
                                        break;
                                    }
                                case 'edituser';
                                    {
                                        include "include/edituser.php";
                                        break;
                                    }
                                 default ;
                                    {
                                        include"include/allusers.php";
                                        break;
                                    }
                            }
                        
                        
                        ?>                  </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "include/footer.php";?>