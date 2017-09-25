<?php 
$numbers = $mysqli->query("SELECT * FROM stanblog_admin_log");
$check = mysqli_num_rows($numbers);
?>
      <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                 

               <li class="">
                        <a href="index.php" ><i class="fa fa-desktop "></i>Dashboard </a>
                    </li>
                   

                    <li class= "">
                        <a href="adm-logs.php"><i class="fa fa-gg "></i>Admin Logs  <span class="badge"><?php echo $check; ?></span></a>
                    </li>

                    <li class= "">
                        <a href="add-post.php"><i class="fa fa-pencil "></i>Add Post  </a>
                    </li>
                    <li class= "">
                        <a href="add-post.php"><i class="fa fa-file "></i>Add Page  </a>
                    </li>
                    
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->