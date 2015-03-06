<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CMS / <?php echo $this->C->a_m; ?> / <?php echo $this->C->a_s; ?></title>

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,500,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo $this->path; ?>/css/custom-theme/jquery-ui-1.10.3.custom.css" />
        <link rel="stylesheet" href="<?php echo $this->path; ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo $this->path; ?>/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo $this->path; ?>/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="<?php echo $this->path; ?>/css/datatables.css" />
        <link rel="stylesheet" href="<?php echo $this->path; ?>/css/theme.css" />

        <script src="<?php echo $this->path; ?>/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo $this->path; ?>/js/jquery-ui.js"></script>
        <script src="<?php echo $this->path; ?>/js/bootstrap.min.js"></script>        
        <script src="<?php echo $this->path; ?>/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo $this->path; ?>/js/datatables.js"></script>
        <script src="<?php echo $this->path; ?>/js/d3.v3.min.js"></script>        
        <script src="<?php echo $this->path; ?>/js/trianglify.min.js"></script>
        <script src="<?php echo $this->path; ?>/js/common.inc.js"></script>
    </head>
    <body>
        <?php
        include("navbar.thm.php");
        ?>
        <div id="main" class="container-fluid" style="">
            <?php
            include("sidebar.thm.php");
            ?>
            <div id="content" class="row-fluid" style="padding: 4px">
                <?php
                //include("subnav.thm.php");
                $o = $this->C->a_o;
                $f = "include/modules/{$this->C->a_m}/{$this->C->a_s}.inc.php";
                if (file_exists($f)) {
                    include($f);
                } else {
                    include("404.thm.php");
                }
                ?>                    
            </div><!-- Content -->
        </div>
    </body>
</html>