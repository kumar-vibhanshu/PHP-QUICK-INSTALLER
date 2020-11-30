<?php

/*
    Quick Installation
    Kumar vibhanshu
    https://github.com/vibhanshumonty
*/

if(file_exists('include/db.inc.php')){
    header('location:index.php');
    die();
}
$msg="";
$host="";
$dbuname="";
$dbpwd="";
$dbname="";
if(isset($_POST['submit'])){
    $host=$_POST['host'];
    $dbuname=$_POST['dbuname'];
    $dbpwd=$_POST['dbpwd'];
    $dbname=$_POST['dbname'];
    
    $con=@mysqli_connect($host,$dbuname,$dbpwd,$dbname);
    if(mysqli_connect_error()){
        $msg=mysqli_connect_error();
    }else{
        copy("../include/db.inc.config.php","../include/db.inc.php");
        $file="../include/db.inc.php";
        file_put_contents($file,str_replace("db_host",$host,file_get_contents($file)));
        file_put_contents($file,str_replace("db_username",$dbuname,file_get_contents($file)));
        file_put_contents($file,str_replace("db_password",$dbpwd,file_get_contents($file)));
        file_put_contents($file,str_replace("db_name",$dbname,file_get_contents($file)));
         
        $sql="CREATE TABLE `page` (
        `id` int(11) NOT NULL,
        `page` varchar(100) NOT NULL,
        `page_content` text NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        mysqli_query($con,$sql); 

        $sql="ALTER TABLE `page` ADD PRIMARY KEY (`id`);";
        mysqli_query($con,$sql);
                
        $sql="ALTER TABLE `page` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
        mysqli_query($con,$sql);
                
        $sql="INSERT INTO `page` (`id`, `page`, `page_content`) VALUES
        (1, 'Home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula urna, dapibus eu nibh sit amet, pharetra varius est. Nam at felis ac dui pretium faucibus sit amet varius odio. In non semper tortor. Aliquam non velit dui. Sed a tincidunt purus. Morbi imperdiet mauris purus, et pellentesque urna consequat et. Proin tincidunt, lacus at blandit elementum, libero urna elementum massa, ac venenatis metus magna ut ligula. Sed ullamcorper orci diam, sit amet suscipit nibh vestibulum eget. Sed pharetra turpis elit, ut mattis arcu laoreet semper. Etiam hendrerit orci ac leo ullamcorper lacinia. Aenean varius suscipit mauris, at placerat elit placerat nec. Nulla scelerisque eget lorem quis fermentum. Morbi in mauris quis purus facilisis ultrices ut sit amet velit. Duis porta consequat lorem, eget scelerisque purus maximus vitae.\r\n\r\n'),
        (2, 'About Us', 'Mauris vel erat et lorem suscipit vulputate. Sed eu hendrerit lorem. Phasellus congue erat varius sapien bibendum, at convallis purus semper. Cras vitae nisi id felis tristique luctus at quis ex. Morbi sed odio at velit molestie pharetra. Fusce sollicitudin, sem sed dapibus elementum, justo ipsum luctus tellus, eu auctor est odio eu dolor. Ut consequat metus in gravida lacinia. Integer euismod convallis sem. Sed venenatis lorem at pharetra tempus. Nulla vitae ante vitae orci maximus fringilla. Vestibulum at scelerisque sem, in porttitor felis. Nunc lacinia pulvinar diam in pulvinar. Nam porttitor ipsum vel arcu dictum placerat. Duis eu dui id sem mattis molestie. Nunc feugiat laoreet sodales. Cras sed molestie sem, non volutpat urna.\r\n\r\n'),
        (3, 'Services', 'Etiam fringilla eros id cursus lobortis. Duis sodales imperdiet urna eu accumsan. Nulla egestas erat at elit consequat, vel ullamcorper velit aliquet. Donec convallis finibus odio, et aliquet urna congue ut. Vestibulum in justo consequat tortor sollicitudin ullamcorper. Curabitur at ullamcorper libero. Nunc risus mauris, condimentum id pellentesque vitae, porta vel tortor. Mauris erat magna, mattis eget ipsum id, imperdiet pellentesque ex. In tincidunt justo vitae velit aliquet ultricies. Nulla porta neque et orci finibus, eget interdum metus sagittis. Donec varius consequat venenatis. Vestibulum lobortis pellentesque sapien nec suscipit. Quisque eu tincidunt libero.\r\n\r\n');";
        $query = mysqli_query($con,$sql);
        
        //To Delete installation directory
        $dir = "../install";
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) 
        {
            if ($file->isDir())
            {
                rmdir($file->getRealPath());
            }else{
                    unlink($file->getRealPath());
                 }
        }
        rmdir($dir);
        header('location:../index.php');        
    }
}
?>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Quick Installer</title>
      <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
            body {
                font-family: Roboto, Sans-Serif,Arial;
            }
            .install-row {
                border:1px solid #e4e5e7;
                border-radius:2px;
                background:#fff;
                padding:15px;
            }
            .logo {
                /* margin-top: 5px;*/
                background: #204cbf;
                padding: 10px 0;
                display: inline-block;
                width: 100%;
                /* border-radius: 5px; */
                margin-bottom: 5px;
                box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23);
            }
            .logo img {
                display:block; width: 185px;
                /* margin:0 auto;*/
            }
            .control-label {
                font-weight:600;
            }
            .padding-10 {
                padding:10px;
            }
            .mbot15 {
                margin-bottom:15px;
            }
            .bg-default {
                background: #7eac05 !important;
                color:#fff;
                /*border:1px solid #FF8000;*/
            }
            .bg-not-passed {
                border:1px solid #e4e5e7;
                border-radius:2px;
            }
            .bold {
                font-weight:600;
            }
            .header{
                margin:0;
                color: white;
                text-align: left;
                font-weight: bold;
                padding-top:3px;
            }
            .newbox.new-box-primary {
                border-top-color: #204cbf;
                box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
            }
            .newbox {
                position: relative;
                padding: 10px 20px 20px;
                border-radius: 3px;
                background: #ffffff;
                border-top: 3px solid #d2d6de;
                margin-bottom: 20px;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
                min-height:46px;
            }
            .new-info-box {
                display: block;
                position:relative;
                min-height: 46px;
                background: #444a52;
                width: 100%;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.25);
                border-radius: 0px;
                margin-bottom: 10px;
                border: 2px solid #fff;
                color: #fff;padding: 5px;
            }
            .m1{ margin-top:20px;}
            .new-info-box i{
                position: absolute;
                left: 0;
                min-width: 50px;
                min-height: 100%;
                font-size: 24px;
                
                top: 0;
                text-align: center;
                padding-top: 10px;
            }
            .new-ii{padding-top: 13px !important}
            .new-info-box h5{padding-left: 60px;}
            .form-control{ border: 0 !important;
                           border-bottom: 1px solid #ccc !important;
                           border-radius: 0; padding: 6px 0px !important;
                           box-shadow: none !important;}
            @media (min-width:768px) and (max-width:992px){
                .new-info-box h5{padding-left: 45px;}
                .new-info-box i{min-width:45px}
            }
        </style>
   </head>
   <body>
      
      <section>
        <div class="logo">
            <div class="container">
                <div class="row">
                    
                        <div class="col-lg-3 col-md-3">
                            <a href="#">
                                <!-- <img src="../backend/images/drtechno-logo-2.png"> -->
                                KV
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <h3 class="header">Kumar Vibhanshu- Quick Installer</h3>
                        </div>
                  
                </div><!--./row-->
            </div><!--./container-->
        </div><!--./row-->
      </section>
        
        <section>
            <div class="container">
                <div class="row">
                    
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="new-info-box bg-default">
                                <i class="fa fa-list-alt h5i new-ii"></i> <h5>Requirements</h5>
                            </div>

                            <div class="new-info-box <?php
                            if ((isset($_GET['step'])) && $_GET['step'] == true || (isset($_GET['step'])) && $_GET['step']==2) {
                                echo 'bg-default';
                            } else {
                                echo 'bg-not-passed';
                            }
                            ?> padding-10">
                                <i class="fa fa-database h5i"></i> <h5> Database</h5>
                            </div>

                            <div class="new-info-box <?php
                            if ((isset($_GET['step'])) && $_GET['step'] == true || (isset($_GET['step'])) && $_GET['step']==3) {
                                echo 'bg-default';
                            } else {
                                echo 'bg-not-passed';
                            }
                            ?> padding-10">
                                <i class="fa fa-thumbs-up h5i"></i> <h5> Finish</h5>

                            </div>

                        </div><!--./col-md-3-->
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="newbox new-box-primary">
                                <?php
                                if((isset($_GET['step'])) && $_GET['step']==2){
                                    ?>
                                    
                                    <form class="frm" method="post">
                                      <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Host" required name="host" value="<?php echo $host?>">
                                      </div>
                                      <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Database User Name" required name="dbuname" value="<?php echo $dbuname?>">
                                      </div>
                                      <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Database Password" name="dbpwd" value="<?php echo $dbpwd?>">
                                      </div>
                                      <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Database Name" required name="dbname" value="<?php echo $dbname?>">
                                      </div>
                                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                      <span class="error"><?php echo $msg?></span>
                                    </form>
                                    
                                    <?php
                                }else{
                                ?>
                              
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th scope="col">Configuration</th>
                                          <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <th scope="row">PHP Version</th>
                                          <td>
                                            <?php
                                                $is_error="";
                                                $php_version=phpversion();
                                                if($php_version>5){
                                                    echo "<span class='success'>".$php_version."</span>";
                                                }else{
                                                    echo "<span class='error'>".$php_version."</span>";
                                                    $is_error='yes';
                                                }
                                            ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Curl Install</th>
                                          <td>
                                            <?php
                                            $curl_version=function_exists('curl_version');
                                            if($curl_version){
                                                echo "<span class='success'>Yes</span>";
                                            }else{
                                                echo "<span class='error'>No</span>";
                                                $is_error='yes';
                                            }
                                            ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Mail Function</th>
                                          <td>
                                            <?php
                                            $mail=function_exists('mail');
                                            if($mail){
                                                echo "<span class='success'>Yes</span>";
                                            }else{
                                                echo "<span class='error'>No</span>";
                                                $is_error='yes';
                                            }
                                            ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Session Working</th>
                                          <td>
                                            <?php
                                            $_SESSION['IS_WORKING']=1;
                                            if(!empty($_SESSION['IS_WORKING'])){
                                                echo "<span class='success'>Yes</span>";
                                            }else{
                                                echo "<span class='error'>No</span>";
                                                $is_error='yes';
                                            }
                                            ?>
                                          </td>
                                        </tr>
                                        
                                        <tr>
                                          <td colspan="2">
                                            <?php 
                                            if($is_error==''){
                                                ?>
                                                <a href="?step=2"><button type="button" class="btn btn-success">Database Setup</button></a>
                                                <?php
                                            }else{
                                                ?><button type="button" class="btn btn-danger">Error</button><?php
                                            }
                                            ?>
                                          </td>
                                        </tr>
                                    </tbody> 
                                </table>
                                <?php } ?>

                            </div><!--./newbox.new-box-primary-->
                        </div>
                </div><!--./row-->
            </div><!--./container-->
        </section>


      <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
      <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
   </body>
</html>